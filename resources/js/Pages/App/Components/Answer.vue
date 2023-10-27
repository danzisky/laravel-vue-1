<template>
    <div class="p-4 border-2 border-blue-300_ rounded-lg bg-gray-100 shadow-lg cursor-pointer" :class="[isSelected ? 'border-blue-400' : '', ]">
        <div>
            <div class="flex">
                <div class="py-2_ px-3 w-max font-bold border-2_ border-blue-400_ text-white_ rounded-lg_ mr-2">
                    {{ option }}
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
        answer: {
            required: true,
            type: Object,
        },
        index: {
            required: true,
            type: Number,
        },
        selectedOption: Number,
    },
    computed: {
        isSelected() {
            return this.selectedOption === this.index ? true : false
        },
        option() {
            const BASE_LETTER = 'A';
            return String.fromCharCode(BASE_LETTER.charCodeAt(0) + this.index);
        }
    }
}
</script>