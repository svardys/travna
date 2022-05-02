<template>
    <form v-if="loaded" @submit.prevent="submit"
          class="space-y-8 divide-y divide-gray-200 max-w-5xl mx-auto">
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-4 gap-6">
                    <div class="col-span-4 font-sansita">
                        Termín
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <Datepicker ref="datepicker" v-model:range="form.reservationRange"
                                    :reserved-dates="reservedDates" :min-date="minDate"
                                    :max-date="maxDate"></Datepicker>
                        <div
                            v-if="form.errors.has('reservationRange_start')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('reservationRange_start')"
                        ></div>
                        <div
                            v-if="form.errors.has('reservationRange_end')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('reservationRange_end')"
                        ></div>
                    </div>
                    <div class="col-span-4 sm:col-span-2 space-y-2">
                        <p><span class="font-semibold font-sansita">Od: </span>{{ currentReservation.start }}</p>
                        <p><span class="font-semibold font-sansita">Do: </span>{{ currentReservation.end }}</p>
                        <p><span class="font-semibold font-sansita">Počet nocí: </span>{{ currentReservation.totalNights }}</p>
                        <p><span class="font-semibold font-sansita">Cena za 1 noc: </span>{{ currentReservation.pricePerNight }}
                        </p>
                        <p><span class="font-semibold font-sansita">Cena celkem: </span>{{ currentReservation.totalPrice }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="first-name"
                               class="block text-sm font-medium text-gray-700 font-sansita">Jméno</label>
                        <input required v-model="form.name" type="text" name="first-name"
                               id="first-name"
                               autocomplete="given-name"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                        <div
                            v-if="form.errors.has('name')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('name')"
                        ></div>
                    </div>

                    <div class="col-span-2">
                        <label for="last-name"
                               class="block text-sm font-medium text-gray-700 font-sansita">Příjmení</label>
                        <input required v-model="form.surname" type="text" name="last-name"
                               id="last-name"
                               autocomplete="family-name"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                        <div
                            v-if="form.errors.has('surname')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('surname')"
                        ></div>
                    </div>

                    <div class="col-span-2">
                        <label for="email-address"
                               class="block text-sm font-medium text-gray-700 font-sansita">Email</label>
                        <input required v-model="form.email" type="email" name="email-address"
                               id="email-address"
                               autocomplete="email"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                        <div
                            v-if="form.errors.has('email')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('email')"
                        ></div>
                    </div>

                    <div class="col-span-2">
                        <label for="phone-number"
                               class="block text-sm font-medium text-gray-700 font-sansita">Telefon</label>
                        <input required v-model="form.phone" type="tel" name="phone-number"
                               id="phone-number"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                        <div
                            v-if="form.errors.has('phone')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('phone')"
                        ></div>
                    </div>
                    <div class="col-span-2">
                        <label for="adult-count"
                               class="block text-sm font-medium text-gray-700 font-sansita">Počet
                            dospělých</label>
                        <input required v-model="form.adultCount" type="number" min="1" max="4"
                               name="adult-count"
                               id="adult-count"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                        <div
                            v-if="form.errors.has('adultCount')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('adultCount')"
                        ></div>
                    </div>

                    <div class="col-span-2">
                        <label for="child-count"
                               class="block text-sm font-medium text-gray-700 font-sansita">Počet
                            dětí</label>
                        <input required v-model="form.childCount" type="number" min="0" max="4"
                               name="child-count"
                               id="child-count"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                        <div
                            v-if="form.errors.has('childCount')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('childCount')"
                        ></div>
                    </div>

                    <div class="col-span-4">
                        <div class="flex items-center h-5">
                            <input v-model="form.pet" id="pet" name="pet" type="checkbox"
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"/>
                            <div class="ml-3 text-sm">
                                <label for="pet" class="font-sansita font-medium text-gray-700">Domácí
                                    mazlíček</label>
                            </div>
                        </div>
                        <div
                            v-if="form.errors.has('pet')"
                            class="mt-1 text-sm text-red-600"
                            v-text="form.errors.get('pet')"
                        ></div>
                    </div>
                </div>

                <input
                    v-model="form.title"
                    type="hidden"
                    id="title"
                    name="title"
                />
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 font-sansita">
                <p>Odesláním rezervačního formuláře souhlasíte se zpracováním osobních údajů dle
                    <b>GDPR</b>.
                </p>
                <button :disabled="!validateForm" type="submit"
                        class="font-sansita inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Rezervovat
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import {ChevronLeftIcon, ChevronRightIcon} from '@heroicons/vue/solid'
import {computed, onMounted, reactive, ref} from "vue";
import {useStore} from "vuex";
import Form from "../../../utilities/form";
import Api from "../../../services/api";
import Datepicker from "../Datepicker";
import {DateTime} from "luxon";
import router from "../../../router";

export default {
    components: {Datepicker, ChevronLeftIcon, ChevronRightIcon},
    setup() {
        const store = useStore();
        const form = reactive(new Form({
            title: '',
            reservationRange: {
                start: '',
                end: ''
            },
            name: '',
            surname: '',
            email: '',
            phone: '',
            adultCount: 1,
            childCount: 0,
            pet: ''
        }));
        const loaded = ref(false);

        const reservedDates = ref([]);

        const reservationSettings = reactive({
            pricePerNight: 2500,
        })
        const datepicker = ref();

        let currentDate = DateTime.now();
        const minDate = currentDate.startOf('day').toISODate();
        const maxDate = currentDate.startOf('day').plus({years: 1}).toISODate();

        const currentReservation = computed(() => {
                let start = (form.reservationRange.start) ? DateTime.fromISO(form.reservationRange.start) : '';
                let end = (form.reservationRange.end) ? DateTime.fromISO(form.reservationRange.end) : '';
                let days = (form.reservationRange.start && form.reservationRange.end) ? end.diff(start, 'days').toObject().days : '';
                return {
                    start: (start) ? start.toFormat('d. M. y') : '-',
                    end: (end) ? end.toFormat('d. M. y') : '-',
                    totalNights: (days) ? end.diff(start, 'days').toObject().days : '-',
                    pricePerNight: `${reservationSettings.pricePerNight.toLocaleString('cs')} Kč`,
                    totalPrice: `${(days) ? (reservationSettings.pricePerNight * days).toLocaleString('cs') : 0} Kč`
                }
            }
        )

        const validateForm = computed(() => {
            //TODO deep rekurze
            return !!form.reservationRange.start && !!form.reservationRange.end
        })

        onMounted(async () => {
                try {
                    const response = await Api.get('/api/reservations');
                    reservedDates.value = response.data;
                    loaded.value = true;
                } catch (e) {
                    await store.dispatch('messagesModule/showException', e.response.data.message);
                    await router.push({name: 'homeIndex'});
                }
            }
        )

        async function submit() {
            try {
                let reservationRange = form.reservationRange
                const response = await Api.post('/api/reservations', form.objectToFormData());
                await store.dispatch('messagesModule/showSuccess', response.data.message);
                datepicker.value.clearRange();
                reservedDates.value.push(reservationRange);
                datepicker.value.renderMonth();
                form.onSuccess();
            } catch (e) {
                if (e.response && e.response.status === 422) {
                    form.onFail(e.response.data.errors);
                } else {
                    await store.dispatch('messagesModule/showException', e.response.data.message);
                }
            }
        }

        return {
            form,
            datepicker,
            reservedDates,
            minDate,
            maxDate,
            currentReservation,
            validateForm,
            loaded,
            submit
        }
    }
}
</script>
