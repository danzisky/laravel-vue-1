<template>
    <Transition name="bounce">
        <div v-if="canSubmit" @click="$emit('submit')"
            class="px-4 py-2 bg-blue-100 rounded-lg border-2 border-blue-400 animate-bounce hover:animate-none
            transition-all ease-in-out delay-75 duration-75">
            Submit
        </div>
    </Transition>
</template>

<script>
export default {
    props: {
        canSubmit: Boolean,
    }
}
</script>

<style scoped>

.bounce-enter-active {
    animation: bounce-in 0.5s;
}

.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }

    50% {
        transform: scale(1.25);
    }

    100% {
        transform: scale(1);
    }
}
</style>