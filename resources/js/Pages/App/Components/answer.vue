<template>
    <div class="p-4 border-2_ border-blue-300_ rounded-lg bg-gray-100">
        <div>
            <div>
                <span class="py-2_ px-3 font-bold border-2_ border-blue-400_ text-white_ rounded-lg_ mr-2">{{ letter }}</span> {{ answer.answer }}
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