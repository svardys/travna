<template>
    <div class="text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 xl:col-start-9">
        <div class="flex items-center text-gray-900">
            <button @click="switchMonth(-1)" :disabled="isPreviousMonthDisabled" type="button"
                    class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                <span class="sr-only">Předchozí měsíc</span>
                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true"/>
            </button>
            <div class="flex-auto font-semibold">{{ selectedMonthName }}</div>
            <button @click="switchMonth(+1)" :disabled="isNextMonthDisabled" type="button"
                    class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                <span class="sr-only">Následující měsíc</span>
                <ChevronRightIcon class="h-5 w-5" aria-hidden="true"/>
            </button>
        </div>
        <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
            <div>Po</div>
            <div>Út</div>
            <div>St</div>
            <div>Čt</div>
            <div>Pá</div>
            <div>So</div>
            <div>Ne</div>
        </div>
        <div
            class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg text-sm shadow ring-1 ring-gray-200">
            <button v-for="(day, index) in selectedMonth.days" type="button" @click="selectRange(day.date)"
                    :class="setClass(day)" :disabled="day.disabled" :key="index">
                <time :datetime="day.date">{{ day.date.split('-').pop().replace(/^0/, '') }}</time>
            </button>
        </div>
        <div v-if="validationMessage" class="text-red-800"> {{ validationMessage }}</div>
        <div class="grid grid-cols-4 mt-3">
            <div>
                <button type="button" class="items-center p-3 border border-transparent rounded-full shadow-sm text-white bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 inline-block"></button>
                <p class="text-xs">Rezervováno</p>
            </div>
            <div>
                <button type="button" class="inline-flex items-center p-3 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></button>
                <p class="text-xs">Označeno</p>
            </div>
            <div>
                <button type="button" class="inline-flex items-center p-3 border border-gray-500 rounded-full shadow-sm text-white bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></button>
                <p class="text-xs">Volno</p>
            </div>
            <div>
                <button type="button" class="inline-flex items-center p-3 border border-gray-500 rounded-full shadow-sm text-white bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></button>
                <p class="text-xs">Blokováno</p>
            </div>
        </div>
    </div>
</template>

<script>

import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/vue/solid";
import {computed, onMounted, reactive, ref} from "vue";
import {DateTime} from "luxon";

export default {
    name: "Datepicker",
    components: {ChevronLeftIcon, ChevronRightIcon},
    props: {
        range: {
            type: Object,
            required: true
        },
        minDate: {
            type: String,
            required: false,
        },
        maxDate: {
            type: String,
            required: false,
        },
        reservedDates: {
            type: Array,
            required: false,
            default: []
        }
    },

    setup(props, {emit}) {

        const selectedRange = reactive({
            start: '',
            end: ''
        });

        const styleConfig = {
            default: 'py-1.5 focus:z-10',
            currentMonth: 'bg-white',
            previousNextMonth: 'text-gray-400 bg-gray-50',
            today: 'text-indigo-600 font-semibold',
            open: 'hover:bg-gray-100',
            disabled: 'text-white bg-gray-600',
            reserved: {
                range: 'bg-red-600',
                start: 'bg-reserved-date-range-start',
                end: 'bg-reserved-date-range-end',
            },
            selected: {
                range: 'text-white bg-indigo-600',
                start: 'text-gray-900 bg-selected-date-range-start',
                end: 'text-gray-900 bg-selected-date-range-end',
            },
            selectedReserved: {
                start: 'text-gray-600 bg-selected-reserved-date-range-start',
                end: 'text-gray-600 bg-selected-reserved-date-range-end',
            }
        }

        const rangeConfig = {
            minimum: 1,
            maximum: 21
        }
        let currentDate = DateTime.now();

        function setClass(day) {
            //DEFAULT
            let cssObject = {
                [styleConfig.default]: true
            }
            //CURRENT MONTH
            if (day.currentMonth && !day.today && !day.selected.isSelected && !day.reserved.isReserved && !day.disabled) {
                cssObject[styleConfig.currentMonth] = true;
            }

            //PREVIOUS NEXT MONTH
            if (!day.currentMonth && !day.today && !day.selected.isSelected && !day.reserved.isReserved && !day.disabled) {
                cssObject[styleConfig.previousNextMonth] = true;
            }

            //TODAY
            if (day.today && !day.isSelected && !day.disabled && !day.selected.isSelected && !day.reserved.isReserved) {
                cssObject[styleConfig.today] = true;
            }

            //DISABLED
            if (day.disabled && !day.today && !day.reserved.isReserved) {
                cssObject[styleConfig.disabled] = true;
            }

            //OPEN
            if (!day.disabled && !day.reserved.isReserved && !day.selected.isSelected) {
                cssObject[styleConfig.open] = true;
            }

            //SELECTED
            if (day.selected.isSelected && !day.reserved.isReserved) {
                if (day.selected.isStart) {
                    cssObject[styleConfig.selected.start] = true;
                } else if (day.selected.isEnd) {
                    cssObject[styleConfig.selected.end] = true;
                } else {
                    cssObject[styleConfig.selected.range] = true;
                }
            }

            //RESERVED
            if (day.reserved.isReserved && !day.selected.isSelected) {
                if (day.reserved.isStart && day.reserved.isEnd) {
                    cssObject[styleConfig.reserved.range] = true;
                } else if (day.reserved.isStart && !day.reserved.isEnd) {
                    cssObject[styleConfig.reserved.start] = true;
                } else if (day.reserved.isEnd && !day.reserved.isStart) {
                    cssObject[styleConfig.reserved.end] = true;
                } else {
                    cssObject[styleConfig.reserved.range] = true;
                }
            }

            //SELECTED RESERVED
            if (day.reserved.isReserved && day.selected.isSelected) {
                if (day.reserved.isStart && day.selected.isEnd) {
                    cssObject[styleConfig.selectedReserved.end] = true;
                } else {
                    cssObject[styleConfig.selectedReserved.start] = true;
                }
            }

            return cssObject
        }

        const selectedMonth = reactive({
            'date': currentDate,
            'days': []
        });

        const validationMessage = ref();

        const minDate = computed(() => {
            if (props.minDate) {
                return props.minDate;
            } else {
                return false;
            }
        });
        const maxDate = computed(() => {
            if (props.maxDate) {
                return props.maxDate;
            } else {
                return false;
            }
        });

        const selectedMonthName = computed(() => {
            return selectedMonth.date.setLocale('cs').monthLong + ' ' + selectedMonth.date.year;
        });

        const isPreviousMonthDisabled = computed(() => {
            if (minDate.value) {
                return DateTime.fromISO(minDate.value).month >= selectedMonth.date.month && selectedMonth.date.year === currentDate.year;
            } else {
                return false;
            }
        });

        const isNextMonthDisabled = computed(() => {
            if (maxDate.value) {
                return maxDate.value <= selectedMonth.date.toISODate()
            } else {
                return false;
            }
        });

        onMounted(() => {
                renderMonth()
            }
        )

        function isCurrentMonth(date) {
            return date.month === selectedMonth.date.month;
        }

        function isToday(date) {
            return date === currentDate.toISODate();
        }

        function isSelected(date) {
            return {
                isSelected: selectedRange.start <= date && date <= selectedRange.end,
                isStart: selectedRange.start === date,
                isEnd: selectedRange.end === date,
            }
        }

        function isReserved(date) {
            return {
                isReserved: props.reservedDates.some((d) => {
                    return d.start <= date && date <= d.end;
                }),
                isStart: props.reservedDates.some((d) => {
                    return d.start === date;
                }),
                isEnd: props.reservedDates.some((d) => {
                    return d.end === date;
                }),
            }
        }

        function isDisabled(date) {
            if (date < minDate.value || date > maxDate.value) {
                return true;
            } else if (props.reservedDates.some((d) => {
                return d.start === date;
            }) && props.reservedDates.some((d) => {
                return d.end === date;
            })) {
                return true
            } else {
                return props.reservedDates.some((d) => {
                    return d.start < date && date < d.end;
                });
            }
        }

        function switchMonth(step) {
            selectedMonth.date = selectedMonth.date.plus({months: step});
            renderMonth();
        }

        function renderMonth() {
            let firstDayOfThisMonth = selectedMonth.date.startOf('month');
            let firstDayOfThisMonthWeekDay = firstDayOfThisMonth.weekday;

            let lastDayOfThisMonth = selectedMonth.date.endOf('month').startOf('day');
            let lastDayOfThisMonthWeekDay = selectedMonth.date.endOf('month').weekday;

            let startDate = firstDayOfThisMonth.minus({days: firstDayOfThisMonthWeekDay - 1});
            let endDate = lastDayOfThisMonth.plus({days: 7 - lastDayOfThisMonthWeekDay});

            let daysDiff = endDate.diff(startDate, 'days').toObject().days + 1;

            selectedMonth.days = [];

            for (let i = 0; i < daysDiff; i++) {
                let isoDate = startDate.toISODate();
                let day = {
                    date: isoDate,
                    currentMonth: isCurrentMonth(startDate),
                    today: isToday(isoDate),
                    selected: isSelected(isoDate),
                    reserved: isReserved(isoDate),
                    disabled: isDisabled(isoDate)
                };
                selectedMonth.days.push(day);
                startDate = startDate.plus({days: 1});
            }
        }

        function selectRange(date) {
            validationMessage.value = '';

            if (!selectedRange.start && !selectedRange.end) {
                selectedRange.start = date;
            } else if (selectedRange.start && selectedRange.end) {
                selectedRange.end = '';
                selectedRange.start = date;
            } else if (selectedRange.start > date) {
                selectedRange.start = date;
            } else if (selectedRange.start === date) {
                selectedRange.start = '';
                selectedRange.end = '';
            } else {
                selectedRange.end = date;
            }

            if (isRangeValid()) {
                showRange();
            } else {
                clearRange();
            }
            emit('update:range', {
                start: selectedRange.start,
                end: selectedRange.end
            });
        }

        function isRangeValid() {
            if (props.reservedDates.some((d) => {
                return d.start === selectedRange.start
            })) {
                return false;
            } else if (selectedRange.start && selectedRange.end) {
                if (props.reservedDates && props.reservedDates.some((d) => {
                    return selectedRange.start <= d.start && d.end <= selectedRange.end;
                })) {
                    validationMessage.value = 'Vybraný termín obsahuje již rezervované termíny';
                    return false;
                } else {
                    let daysDiff = DateTime.fromISO(selectedRange.end).diff(DateTime.fromISO(selectedRange.start), 'days').toObject().days;
                    if (daysDiff < rangeConfig.minimum) {
                        validationMessage.value = `Vybrali jste příliš malé rozpětí - (${rangeConfig.minimum}) dnů`;
                        return false;
                    } else if (daysDiff >= rangeConfig.maximum) {
                        validationMessage.value = `Vybrali jste příliš velké rozpětí - delší než (${rangeConfig.maximum}) dnů`;
                        return false;
                    } else {
                        return true;
                    }
                }
            }
            return true;
        }

        function showRange() {
            selectedMonth.days.forEach(function (day) {
                day.selected.isSelected = false;
                day.selected.start = false;
                day.selected.end = false;
            })

            let startIndex = selectedMonth.days.findIndex(
                (day) => {
                    return day.date === selectedRange.start;
                }
            );

            //START SELECTED
            if (selectedRange.start && !selectedRange.end) {
                selectedMonth.days[startIndex].selected.isSelected = true;
                selectedMonth.days[startIndex].selected.isStart = true;
            }
            //END SELECTED
            if (selectedRange.end) {

                let endIndex = selectedMonth.days.findIndex(
                    (day) => {
                        return day.date === selectedRange.end;
                    }
                );

                selectedMonth.days[endIndex].selected.isSelected = true;
                selectedMonth.days[endIndex].selected.isEnd = true;

                //START IS OUTSIDE SELECTED MONTH
                if (startIndex === -1 && endIndex !== -1) {
                    for (let i = 0; i <= endIndex; i++) {
                        selectedMonth.days[i].selected.isSelected = true;
                        selectedMonth.days[i].selected.isEnd = i === endIndex;
                    }
                }
                //START IS INSIDE SELECTED MONTH
                else {
                    let count = endIndex - startIndex;
                    for (let i = 0; i <= count; i++) {
                        selectedMonth.days[startIndex + i].selected.isSelected = true;
                        selectedMonth.days[startIndex + i].selected.isStart = startIndex + i === startIndex;
                        selectedMonth.days[startIndex + i].selected.isEnd = startIndex + i === endIndex;
                    }
                }
            }
        }

        function clearRange() {
            selectedMonth.days.forEach(function (day) {
                day.selected.isSelected = false;
                day.selected.start = false;
                day.selected.end = false;
            })
            selectedRange.start = '';
            selectedRange.end = '';
        }

        return {
            selectedMonth,
            selectedMonthName,
            selectedRange,
            isPreviousMonthDisabled,
            isNextMonthDisabled,
            validationMessage,
            isDisabled,
            setClass,
            switchMonth,
            selectRange,
            clearRange,
            renderMonth
        }
    }
}
</script>
