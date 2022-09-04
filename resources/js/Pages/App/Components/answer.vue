<template>
    <div class="p-4 border-2 border-blue-300_ rounded-lg bg-gray-100" :class="[selected ? 'border-blue-400' : '', errorClass]">
        <div>
            <div class="flex">
                <div class="py-2_ px-3 w-max font-bold border-2_ border-blue-400_ text-white_ rounded-lg_ mr-2">
                    {{ letter }}
                </div>
                <div>
                    {{ answer.answer }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        answer: Object,
        index: Number,
        selectedOption: Number,
    },
    data() {
        return {
            letter: null,
            selected: false,
        }
    },
    mounted() {
        this.letter = this.option(this.index);
        this.isSelected()
    },
    beforeUpdate() {
        this.isSelected()
    },
    updated() {
        console.log('updated answer')
        this.isSelected()
    },
    methods: {
        option(increment) {
            const BASE_LETTER = 'A';
            return String.fromCharCode(BASE_LETTER.charCodeAt(0) + increment);
        },
        isSelected() {
            this.selected = this.selectedOption === this.index ? true : false
        }
    }
}
</script>