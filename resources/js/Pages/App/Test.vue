<template>
    <Base>

    <Head title="Home" />
    <div class="grid grid-cols-1 place-content-center">
        <div class="m-auto_ p-8 flex flex-col items-center">
            <div class="p-4">
                <Question v-for="question in questions" :key="question.id" :question="question" />
            </div>
        </div>
    </div>
    </Base>
</template>

<script>
import Base from "./Base.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Question from "./Components/question.vue";

const QUESTIONS_URL = "http://127.0.0.1:8000/api/questions"

export default {
    data() {
        return {
            questions: [],
        };
    },

    created() {
        this.fetchData()
    },
    
    methods: {
        async fetchData() {
            this.questions = await (await fetch(QUESTIONS_URL)).json();
            this.questions = this.questions.data ? this.questions.data : []
            console.log(this.questions)
            // this.questions = json_decode(this.questions)
        },
    },
    components: {
        Base,
        Question,
    }
}

</script>

<style>
</style>