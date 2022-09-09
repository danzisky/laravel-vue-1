<template>
    <Transition name="bounce">
        <div v-if="question.isCurrent" class="p-4 bg-gray-200 rounded-lg" >
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
    },
    updated() {
        console.log('updated question component')
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