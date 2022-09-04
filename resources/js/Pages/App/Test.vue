<template>
    <Base>

    <Head title="Home" />
    <div class="grid grid-cols-1 place-content-center">
        <div class="m-auto_ p-8 flex flex-col items-center">
            <div class="p-4">
                <Question v-for="question in questions" :key="question.id" :question="question" />
            </div>
        </div>
        <div class="m-auto_ p-8 ">
            <div class="flex justify-center space-x-4">
                <div class="px-4 py-2 bg-blue-300 rounded-lg">
                    Previous
                </div>
                <div class="px-4 py-2 bg-blue-300 rounded-lg">
                    Next
                </div>
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
            currentQuestion: null,
        };
    },

    created() {
        this.fetchData()
        this.currentQuestion = 0
    },
    
    methods: {
        async fetchData() {
            var questions = await (await fetch(QUESTIONS_URL)).json();

            questions = questions.data ? questions.data : []

            questions.forEach((question, index) => {
                question.isCurrent = index == 0 ? true : false
            });

            this.questions = questions
            console.log(this.questions)
            // this.questions = json_decode(this.questions)
        },
        nestQuestion() {
            this.currentQuestion++
        },
        previousQuestion() {

        }
    },
    components: {
        Base,
        Question,
    }
}

</script>

<style>
</style>