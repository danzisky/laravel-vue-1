<template>
    <Transition name="bounce">
        <button v-if="canSubmit" @click="$emit('submit')"
            class="px-4 py-2 bg-blue-100_ rounded-lg border-2 border-blue-100 hover:animate-none text-white transition ease-in-out delay-150 bg-blue-400 hover:-translate-y-1 focus:-translate-y-1 hover:scale-110 focus:scale-110 hover:bg-indigo-500 duration-300">
            {{ buttonText }}
        </button>
    </Transition>
</template>

<script>
export default {
    props: {
        buttonText: String,
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