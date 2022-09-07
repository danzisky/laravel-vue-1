<template>
    <div _v-if="canSubmit" @click="$emit('submit')"
        class="px-4 py-2 bg-blue-100 rounded-lg border-2 border-blue-400 animate-bounce hover:animate-none
        transition-all ease-in-out delay-75 duration-75">
        Submit
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>