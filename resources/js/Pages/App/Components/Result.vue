<template>
    <Transition name="bounce">
        <div v-if="showing"
            class="mx-2 sm:mx-auto fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75 z-10"
            @click.self="close" @click.away="close">
            <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg p-8">
                <button aria-label="close" class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
                    @click.prevent="close">
                    ×
                </button>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Personality Type</h2>
                    <p class="mb-1">Your answers are {{ personalityPercentages.introvertScore.toFixed(2) }}%
                        introverted and {{
                        personalityPercentages.extrovertScore.toFixed(2) }}% extroverted
                    </p>
                    <p class="mb-6 text-lg font-bold animate-pulse">
                        You are an {{ personalityType }}!
                    </p>
                    <button
                        class="bg-blue-600 text-white px-4 py-2 text-sm uppercase tracking-wide font-bold rounded-lg"
                        @click="showResults = false">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </Transition>
</template>
 
<script>
export default {
  props: {
    showing: {
      required: true,
      type: Boolean
    },
    personalityPercentages: Object,
    personalityType: String,
  },
  watch: {
    showing(value) {
      if (value) {
        return document.querySelector('body').classList.add('overflow-hidden');
      }
 
      document.querySelector('body').classList.remove('overflow-hidden');
    }
  },
  methods: {
    close() {
      this.$emit('close');
    }
  }
};
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