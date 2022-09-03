<template>
    <div class="p-4 border border-blue-300 rounded-lg">
        <div>
            <div>
                {{ letter }}: {{ answer.answer }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        answer: Object,
        index: Number,
    },
    data() {
        return {
            letter: null,
        }
    },
    mounted() {
        this.letter = this.option(this.index);
    },
    methods: {
        option(increment) {
            const BASE_LETTER = 'A';
            return String.fromCharCode(BASE_LETTER.charCodeAt(0) + increment);
        }
    }
}
</script>