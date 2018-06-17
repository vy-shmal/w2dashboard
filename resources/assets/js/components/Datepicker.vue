<script>
    import DatePicker from 'vue2-datepicker'

    export default {
        components: { DatePicker },
        data() {
            return {
                time1: '',
                time2: '',
                time3: '',
                shortcuts: [
                    {
                        text: 'Today',
                        start: new Date(),
                        end: new Date()
                    }
                ],
                timePickerOptions:{
                    start: '00:00',
                    step: '00:30',
                    end: '23:30'
                }
            }
        }
    }
</script>

<template>
    <div>
        <date-picker v-model="time1" lang="en" :first-day-of-week="1"></date-picker>
    </div>
</template>