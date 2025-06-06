<script setup>
import md5 from 'crypto-js/md5'
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import PrimaryButton from '@/components/PrimaryButton.vue'
import DeleteButton from '@/components/DeleteButton.vue'

const props = defineProps({
  comments: Array,
  companyId: Number,
})

const user = usePage().props.auth.user
const newComment = ref('')
const editingComment = ref(null)
const editedText = ref('')

function postComment() {
  if (!newComment.value.trim()) return;

  router.post('/comments', {
    company_id: props.companyId,
    comment: newComment.value,
  }, {
    preserveScroll: true,
    replace: true,
    onFinish: () => {
      newComment.value = '';
    },
  });
}

const startEdit = (comment) => {
  editingComment.value = comment.id
  editedText.value = comment.comment
}

const cancelEdit = () => {
  editingComment.value = null
  editedText.value = ''
}

const saveEdit = (commentId) => {
  router.put(`/comments/${commentId}`, { comment: editedText.value }, {
    preserveScroll: true,
    onSuccess: () => {
      cancelEdit()
    }
  })
}

function deleteComment(commentId) {
  if (confirm('Are you sure you want to delete this comment?')) {
    router.delete(`/comments/${commentId}`, {
      preserveScroll: true,
    });
  }
}

function restoreComment(commentId) {
  router.patch(`/comments/${commentId}/restore`, {}, {
    preserveScroll: true,
  });
}

</script>

<template>
  <div class="mt-10 space-y-5">
    <h3 class="text-lg font-semibold">Comments</h3>

    <div v-if="user" class="mb-4">
      <textarea v-model="newComment" rows="3" placeholder="Leave a comment..."
        class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white" />
      <PrimaryButton @click="postComment">
        Post
      </PrimaryButton>
    </div>

    <div v-if="comments.length === 0" class="text-gray-500 dark:text-gray-400">
      No comments yet.
    </div>

    <div v-for="comment in comments" :key="comment.id" class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 mb-4 shadow-sm bg-white dark:bg-gray-800">
        <div class="flex items-start space-x-3">
        <img
            :src="`https://www.gravatar.com/avatar/${md5(comment.user.email.trim().toLowerCase())}?s=40&d=identicon`"
            alt="avatar"
            class="w-5 h-5 rounded-full"
        />
       
      <p class="text-sm text-gray-500 dark:text-gray-400">{{ comment.user.email }} · {{ new Date(comment.created_at).toLocaleString() }}</p>
             </div>

          <div v-if="comment.deleted_at" class="italic text-gray-400 pt-3 pb-3">
          This comment was deleted.
          </div>

      <div v-if="editingComment === comment.id">
        <textarea v-model="editedText" rows="3" class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white" />
        <div class="mt-2 space-x-2">
          <PrimaryButton @click="saveEdit(comment.id)">Save</PrimaryButton>
          <PrimaryButton @click="cancelEdit">Cancel</PrimaryButton>
        </div>
      </div>
      <div v-else>
        <p class="mt-1 text-gray-800 dark:text-gray-100 pb-3 pt-3">{{ comment.comment }}</p>

        <template v-if="!comment.deleted_at && user && comment.user_id === user.id">
        <PrimaryButton @click="startEdit(comment)">
          Edit
        </PrimaryButton>

        <DeleteButton @click="deleteComment(comment.id)">
          Delete
        </DeleteButton>
      </template>

        <PrimaryButton
        v-if="user && comment.user_id === user.id && comment.deleted_at"
        @click="restoreComment(comment.id)"
        >
        Restore
        </PrimaryButton>

        
      </div>
    </div>
  </div>
</template>
