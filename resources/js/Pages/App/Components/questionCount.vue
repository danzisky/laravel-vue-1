<template>
  <div class="p-2 border-2 border-blue-300 rounded-lg">
    Question {{ currentQuestion + 1 }} / {{ questionsLength }}
  </div>
</template>

<script>
export default {
    props: {
        questionsLength: Number,
        currentQuestion: Number,
    }
}
</script>

<style>

</style>