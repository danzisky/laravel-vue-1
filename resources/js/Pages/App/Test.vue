<template>
    <Base>

    <Head title="Home" />
    <div class="grid grid-cols-1 place-content-center text-blue-400 font-semibold_">
        <div class="m-auto_ p-8 flex flex-col items-center">
            <div class="p-4 w-full flex justify-end">
                <QuestionCount :questionsLength="questions.length" :currentQuestion="currentQuestion" />
            </div>
            <div class="p-4">
                <Question v-for="(question, index) in questions" :key="question.id" :question="question" :questionIndex="index"
                    @select-option="selectOption" />
            </div>
        </div>
        <div class="m-auto_ p-8 ">
            <div class="flex justify-center space-x-4">
                <div v-if="previousQuestionAvailable" class="px-4 py-2 bg-blue-100 rounded-lg" @click="previousQuestion">
                    Previous
                </div>
                <div v-else class="px-4 py-2 bg-gray-200 text-gray-300 rounded-lg">
                    Previous
                </div>
                <div v-if="nextQuestionAvailable" class="px-4 py-2 bg-blue-100 rounded-lg" @click="nextQuestion">
                    Next
                </div>
                <div v-else class="px-4 py-2 bg-blue-100 rounded-lg" @click="nextQuestion">
                    Submit
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
import QuestionCount from "./Components/questionCount.vue";

const QUESTIONS_URL = "http://127.0.0.1:8000/api/questions"

export default {
    data() {
        return {
            questions: [],
            currentQuestion: null,
            nextQuestionAvailable: false,
            previousQuestionAvailable: false,
        };
    },

    created() {
        this.currentQuestion = 0
        this.fetchData()
    },

    updated() {
        console.log("updated base")
    },
    
    methods: {
        async fetchData() {
            var questions = await (await fetch(QUESTIONS_URL)).json();

            questions = questions.data ? questions.data : []
            
            this.questions = questions
            this.showCurrentQuestion()
            this.nullSelectedOption()
            console.log(this.questions)
        },
        selectOption(questionIndex, answerIndex) {
            return this.questions[questionIndex].selectedOption =answerIndex
        },
        showCurrentQuestion() {
            console.log(this.currentQuestion)
            this.questions.forEach((question, index) => {
                return question.isCurrent = index == this.currentQuestion ? true : false
            })
            this.nextQuestionAvailable = this.questions.length <= this.currentQuestion + 1 ? false : true
            this.previousQuestionAvailable = (this.questions.length >= this.currentQuestion && this.currentQuestion >= 1) ? true : false
        },
        nullSelectedOption() {
            // console.log('nulling selected')
            this.questions.forEach((question, index) => {
                return question.selectedOption =  null
            })
            // console.log(this.questions.length)
            // console.log('nulled selected')
        },
        nextQuestion(event) {
            this.currentQuestion++
            this.showCurrentQuestion()
        },
        previousQuestion(event) {
            this.currentQuestion--
            this.showCurrentQuestion()
        }
    },
    components: {
    Base,
    Question,
    QuestionCount
}
}

</script>

<style>
</style>