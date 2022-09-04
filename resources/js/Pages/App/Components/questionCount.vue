<template>
  <div>
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