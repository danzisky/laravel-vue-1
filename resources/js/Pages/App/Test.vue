<template>
    <Base>

    <Head title="Home" />
    <div class="grid grid-cols-1 place-content-center text-blue-400 font-semibold_">
        <div>
            <Result :showing="showResults" :personalityPercentages="personalityPercentages" :personalityType="personalityType" @close="showResults = false"/>
        </div>
        <div class="m-auto_ p-8 flex flex-col items-center">
            <div class="p-4 w-full flex justify-end">
                <QuestionCount :questionsLength="questions.length" :currentQuestion="currentQuestion" />
            </div>
            <div class="p-4">
                <Question v-for="(question, index) in questions" :key="question.id" :question="question"
                    :questionIndex="index" @select-option="selectOption" />
            </div>
        </div>
        <div class="m-auto_ p-8 ">
            <div class="flex justify-center space-x-4">
                <div v-if="previousQuestionAvailable" class="px-4 py-2 bg-blue-100 rounded-lg"
                    @click="previousQuestion">
                    Previous
                </div>
                <div v-else class="px-4 py-2 bg-gray-200 text-gray-300 rounded-lg">
                    Previous
                </div>
                <div v-if="nextQuestionAvailable" class="px-4 py-2 bg-blue-100 rounded-lg" @click="nextQuestion">
                    Next
                </div>
                <div v-else class="px-4 py-2 bg-blue-100 rounded-lg" @click="submit">
                    Submit
                </div>
            </div>
        </div>
    </div>
    </Base>
</template>
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<script>
import Base from "./Base.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Question from "./Components/question.vue";
import QuestionCount from "./Components/questionCount.vue";
import Result from "./Components/result.vue";

const QUESTIONS_URL = "http://127.0.0.1:8000/api/questions"

export default {
    data() {
        return {
            questions: [],
            currentQuestion: null,
            nextQuestionAvailable: false,
            previousQuestionAvailable: false,
            showResults: false,
            result: [],
        };
    },
    computed: {
        personalityType() {
            if(this.result.extrovertScore > this.result.introvertScore) {
                return "Extrovert"
            } else if(this.result.introvertScore > this.result.extrovertScore) {
                return "Introvert"
            } else {
                return "Ambivert"
            }
        },
        personalityPercentages() {
            var result = this.result
            return {
                introvertScore: (this.result.introvertScore/(this.result.introvertScore+this.result.extrovertScore)).toFixed(2)*100,

                extrovertScore: (this.result.extrovertScore/(this.result.introvertScore+this.result.extrovertScore)).toFixed(2)*100,
            }
        }
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
            // console.log(this.questions)
        },
        selectOption(questionIndex, answerIndex) {
            return this.questions[questionIndex].selectedOption = this.questions[questionIndex].selectedOption === answerIndex ? null : answerIndex;
        },
        showCurrentQuestion() {
            // console.log(this.currentQuestion)
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
        },
        submit() {
            var allFilled = this.questions.every(checkOptionsSelected)

            function checkOptionsSelected(question) {
                return (question.selectedOption !== null && !isNaN(question.selectedOption));
            }

            if(!allFilled) {
                alert("Please fill all options")
            } else {
                // alert("submitting")
                console.log("submitting")
                const RESULT = this.questions.map((question) => {
                    console.log(question.selectedOption)
                    return {
                        question_id: question.id,
                        anchor_rank: question.anchor_rank,
                        peak_personality: question.peak_personality,
                        answer_id: question.answers[question.selectedOption].id,
                        answer_rank: question.answers[question.selectedOption].rank,
                    }
                })
                var scores = this.getPersonalityScores(RESULT)
                console.log(scores)
                /* if(scores.includes('data')) {
                    this.showResults = true
                } */
            }


        },
        async getPersonalityScores(RESULT) {
            const RESULT_URL = "http://127.0.0.1:8000/api/result"
            var resultRequest = {
                testResponse: RESULT
            }
            console.log(resultRequest)
            var res = await axios.post(RESULT_URL, resultRequest)
            console.log(res.data)

            if(res.data) {
                this.showResults = true
                this.result = res.data
            }
            return res
        },
    },
    components: {
    Head,
    Base,
    Question,
    QuestionCount,
    Result
}
}

</script>