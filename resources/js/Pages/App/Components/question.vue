<template>
    <Transition name="bounce">
        <div v-if="question.isCurrent" class="p-4 bg-gray-200 rounded-lg" >
            <!-- :class="[question.isCurrent ? 'transition ease-linear ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300' : '', ]" -->
            <div class="">
                <div class="flex p-4 bg-blue-400 rounded-lg text-white text-lg">
                    <div class="px-3 w-max font-bold mr-2">
                        Q{{ questionIndex+1 }}.
                    </div>
                    <div>
                        {{ question.question }}
                    </div>
                </div>
                <div class="m-auto p-8 flex flex-col space-y-4">
                    <div class="space-y-4">
                        <Answer v-for="(answer, index) in answers" :key="answer.id" :answer="answer"
                            :selectedOption="question.selectedOption" :index="index"
                            @click="$emit('selectOption', questionIndex, index)" />
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
import Answer from "./answer.vue"
export default {
    props: {
        question: Object,
        questionIndex: Number,
    },
    data() {
        return {
            answers: this.question.answers ?? [],
        };
    },
    created() {
        this.answers = this.question.answers ?? []
        // console.log(this.question.selectedOption)
        // console.log(this.answers)
    },
    updated() {
        console.log('updated question')
    },
    components: {
        Answer
    }
}
</script>

<style>
.bounce-enter-active {
    animation: bounce-in 0.7s;
}

.bounce-leave-active {
    animation: bounce-in 0s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0.4);
    }

    50% {
        transform: scale(1.1);
    }

    100% {
        transform: scale(1);
    }
}
</style>