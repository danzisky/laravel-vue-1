<template>
  <div class="p-2 border-2 border-blue-300 rounded-lg">
    Question {{ currentQuestionNo }} / {{ questionsLength }}
  </div>
</template>

<script>
export default {
    props: {
        questionsLength: Number,
        currentQuestion: Number,
    },
    computed: {
      currentQuestionNo() {
        return this.currentQuestion + 1 <= this.questionsLength ? this.currentQuestion + 1 : this.questionsLength
      }
    }
}
</script>

<style>

</style>