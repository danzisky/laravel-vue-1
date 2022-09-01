<template>
    <div class="p-2 bg-slate-200">
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