import {createWebHistory, createRouter} from "vue-router";
import store from "../store";

//Public
import LandingPage from "../components/public/LandingPage";
import HomeIndex from "../components/public/home/HomeIndex";
import ReservationForm from "../components/public/home/ReservationForm";
import Contact from "../components/public/home/Contact";

import NotFound from '../components/public/NotFound'

//Admin
import AdminPage from '../components/admin/AdminPage'
import Reservations from '../components/admin/Reservations'
import Settings from '../components/admin/Settings'
import UserSettings from '../components/admin/UserSettings'

//Auth
import Login from '../components/auth/Login'
import ForgotPassword from '../components/auth/ForgotPassword'
import ResetPassword from '../components/auth/ResetPassword'

//Routes
const routes = [
    {
        path: '/admin',
        name: 'adminPage',
        component: AdminPage,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: 'rezervace',
                name: 'reservations',
                component: Reservations,
            },
            {
                path: 'nastaveni',
                name: 'settings',
                component: Settings,
            },
            {
                path: 'uzivatelske-nastaveni',
                name: 'userSettings',
                component: UserSettings,
            },
        ]
    },
    {
        path: '/',
        component: LandingPage,
        meta: {
            hideHeader: false,
            showValue: "Chata Travná",
        },
        children: [
            {
                path: '',
                name: 'homeIndex',
                component: HomeIndex,
                meta: {
                    hideHeader: false,
                    showValue: "Chata Travná"
                },
            },
            {
                path: 'rezervace',
                name: 'reservationsForm',
                component: ReservationForm,
                meta: {
                    hideHeader: true,
                    showValue: "Rezervace"
                },
            },
            {
                path: 'kontakt',
                name: 'contact',
                component: Contact,
                meta: {
                    hideHeader: true,
                    showValue: "Kontakt"
                }
            }
        ]
    },

    //Auth
    {
        path: '/auth/prihlaseni',
        name: 'login',
        component: Login,
        meta: {
            guest: true
        }
    },
    {
        path: '/auth/zapomenute-heslo',
        name: 'forgotPassword',
        component: ForgotPassword,
        meta: {
            guest: true
        }
    },
    {
        path: '/auth/reset-hesla',
        name: 'resetPassword',
        component: ResetPassword,
        meta: {
            guest: true
        }
    },

    //404
    {
        path: '/:pathMatch(.*)*',
        name: 'notFound',
        component: NotFound,
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {

    const loggedIn = store.getters['userModule/loggedIn']

    const canNavigate = to.matched.some(() => {
        if (!loggedIn && to.meta.requiresAuth) {
            return false
        } else return !(loggedIn && to.meta.guest)
    })

    if (!canNavigate) {
        return next('/')
    } else {
        next()
    }
})

export default router;
