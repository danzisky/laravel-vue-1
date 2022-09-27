<template>
<Head title="Home" />
    <div class="grid grid-cols-1 place-content-center text-blue-400 font-semibold_">
        <div class="z-10">
            <div v-if="showResults" class="absolute w-full h-screen top-0 right-0 bg-gray-600 opacity-70 transition-all duration-500"></div>
            <Result :showing="showResults" :personalityPercentages="personalityPercentages"
                :personalityType="personalityType" @close="showResults = false" />
        </div>
        <div class="m-auto_ sm:p-8 flex flex-col items-center">
            <div class="p-4 w-full flex justify-end">
                <QuestionCount :questionsLength="questions.length" :currentQuestion="currentQuestion" />
            </div>
            <div class="p-1 sm:p-4">
                <Question v-for="(question, index) in questions" :key="question.id" :question="question"
                    :questionIndex="index" @select-option="selectOption" />
            </div>
        </div>
        <div class="m-auto_ p-2 sm:p-8 ">
            <div class="flex justify-center space-x-4">
                <button v-if="previousQuestionAvailable" class="px-4 py-2 bg-blue-100 hover:text-white hover:bg-blue-300 rounded-lg"
                    @click="previousQuestion">
                    Previous
                </button>
                <button v-else class="px-4 py-2 bg-gray-200 text-gray-300 rounded-lg">
                    Previous
                </button>
                <button v-if="nextQuestionAvailable" class="px-4 py-2 bg-blue-100 hover:text-white hover:bg-blue-300 rounded-lg" @click="nextQuestion">
                    Next
                </button>
                <button v-else class="px-4 py-2 bg-gray-200 text-gray-300 rounded-lg">
                    Next
                </button>
            </div>
            <div class="w3-full border m-4"></div>
            <div class="flex justify-center space-x-4 mx-auto p-4_ bg">
                <SubmitButton :buttonText="'Reset'" :canSubmit="true" @click="reset" />
                <SubmitButton v-if="canSubmit" SubmitButton :buttonText="'Submit'" :canSubmit="canSubmit == true" @submit="submit" />
            </div>
        </div>
    </div>
</template>
<script>
import Base from "./Base.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Question from "./Components/Question.vue";
import QuestionCount from "./Components/QuestionCount.vue";
import Result from "./Components/Result.vue";
import SubmitButton from "./Components/SubmitButton.vue";


const QUESTIONS_URL = "http://127.0.0.1:8000/api/questions"


export default {
    layout: Base,
    data() {
        return {
            questions: [],
            currentQuestion: null,
            nextQuestionAvailable: false,
            previousQuestionAvailable: false,
            showResults: false,
            canSubmit: false,
            result: [],
        };
    },
    mounted() {
        this.currentQuestion = 0

        if((this.questions[0] ?? null) === null) {
            this.fetchData()
        } else if((this.questions[0] ?? null) !== null) {
            this.showCurrentQuestion()
        }
    },
    watch: {
        questions() {
            return this.optionsFilled() ? this.canSubmit = true : false
        }
    },
    
    methods: {
        async fetchData() {
            this.canSubmit = false
            var questions = await (await fetch(QUESTIONS_URL)).json();
            console.log(questions)
            questions = questions.data ? questions.data : []
            
            this.questions = questions
            this.showCurrentQuestion()
            this.nullSelectedOption()
        },
        selectOption(questionIndex, answerIndex) {
            
            this.questions[questionIndex].selectedOption = this.questions[questionIndex].selectedOption === answerIndex ? null : answerIndex;
            
            this.canSubmit = this.optionsFilled() ? true : false
            
            return
        },
        showCurrentQuestion() {
            this.questions.forEach((question, index) => {
                return question.isCurrent = index == this.currentQuestion ? true : false
            })
            this.nextQuestionAvailable = this.questions.length <= this.currentQuestion + 1 ? false : true
            this.previousQuestionAvailable = (this.questions.length >= this.currentQuestion && this.currentQuestion >= 1) ? true : false
        },
        nullSelectedOption() {
            this.questions.forEach((question, index) => {
                return question.selectedOption =  null
            })
        },
        nextQuestion(event) {
            this.currentQuestion++
            this.showCurrentQuestion()
        },
        previousQuestion(event) {
            this.currentQuestion--
            this.showCurrentQuestion()
        },
        reset() {
            this.currentQuestion = 0
            this.fetchData()
            this.canSubmit = false
        },
        submit() {
            var allFilled = this.optionsFilled()
            
            if(!allFilled) {
                alert("Please fill all options")
            } else {
                console.log("submitting")
                const RESULT = this.questions.map((question) => {
                    return {
                        question_id: question.id,
                        anchor_rank: question.anchor_rank,
                        peak_personality: question.peak_personality,
                        answer_id: question.answers[question.selectedOption].id,
                        answer_rank: question.answers[question.selectedOption].rank,
                    }
                })
                var scores = this.getPersonalityScores(RESULT)
                // console.log(scores)
            }


        },
        async getPersonalityScores(RESULT) {
            const RESULT_URL = "http://127.0.0.1:8000/api/result"
            var resultRequest = {
                testResponse: RESULT
            }

            var res = await axios.post(RESULT_URL, resultRequest)

            if(res.data) {
                this.showResults = true
                this.result = res.data
            }
            return res
        },
    },
    computed: {
        personalityType() {
            if (this.result.extrovertScore > this.result.introvertScore) {
                return "Extrovert"
            } else if (this.result.introvertScore > this.result.extrovertScore) {
                return "Introvert"
            } else {
                return "Ambivert"
            }
        },
        personalityPercentages() {
            var result = this.result
            return {
                introvertScore: (this.result.introvertScore / (this.result.introvertScore + this.result.extrovertScore)).toFixed(3) * 100,

                extrovertScore: (this.result.extrovertScore / (this.result.introvertScore + this.result.extrovertScore)).toFixed(3) * 100,
            }
        },
        optionsFilled() {
            return this.questions.every(checkOptionsSelected)

            function checkOptionsSelected(question) {
                return ((question.selectedOption ?? null) !== null && !isNaN(question.selectedOption));
            }

        },
    },
    components: {
        Head,
        Base,
        Question,
        QuestionCount,
        Result,
        SubmitButton
    }
}

</script>