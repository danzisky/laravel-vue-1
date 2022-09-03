<template>
    <div class="p-4 bg-slate-200">
        <div>
            <div class="p-4 bg-blue-300 rounded-lg">
                Q: {{ question.question }}
            </div>
            <div class="m-auto p-8 flex flex-col space-y-4">
                <div class="space-y-4">
                    <Answer v-for="(answer, index) in answers" :key="answer.id" :answer="answer" :index="index" />
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
    },
    data() {
        return {
            answers: this.question.answers ?? [],
            question: this.question,
        };
    },
    created() {
        this.answers = this.question.answers ?? []
        console.log(this.answers)
    },
    components: {
        Answer
    }
}
</script>