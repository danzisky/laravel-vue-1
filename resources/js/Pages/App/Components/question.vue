<template>
    <div class="p-2 bg-slate-200">
        <div>
            <div>
                Q: {{ question.question }}
            </div>
            <div class="m-auto p-8 flex flex-col space-y-4">
                <div class="">
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