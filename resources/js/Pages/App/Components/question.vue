<template>
    <div v-if="question.isCurrent" class="p-4 bg-gray-200 rounded-lg">
        <div class="">
            <div class="flex p-4 bg-blue-400 rounded-lg text-white text-lg">
                <div class="px-3 w-max font-bold mr-2">
                    Q
                </div>
                <div>
                    {{ question.question }}
                </div>
            </div>
            <div class="m-auto p-8 flex flex-col space-y-4">
                <div class="space-y-4">
                    <Answer v-for="(answer, index) in answers" :key="answer.id" :answer="answer" :selectedOption="question.selectedOption" :index="index"
                        @click="$emit('selectOption', questionIndex, index)" />
                </div>
            </div>
        </div>
    </div>
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
            // question: this.question,
        };
    },
    created() {
        this.answers = this.question.answers ?? []
        console.log(this.question.selectedOption)
        // console.log(this.answers)
    },
    updated() {
        console.log('updated question')
        console.log(this.question.selectedOption)
        this.answers = this.question.answers ?? []
    },
    components: {
        Answer
    }
}
</script>