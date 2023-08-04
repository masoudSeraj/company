export const routes = () => {
    return{
        login: {
            create:{ 
                path: '/company/sunnyr-login' 
            },
            post:{
                path: '/company/sunnyr-login' 
            }
        },

        register: {
            create:{
                path: '/company/sunnyr-register'
            },
            store: {
                path: '/company/sunnyr-register'
            }
        },

        verification: {
            request: {
                path: '/company/request-for-verification'
            },
            submit: {
                path: '/company/submit-verification'
            },
            verify:{
                path: '/company/sunnyr-verify-phone'
            }
        },

        logout: {
            post: {
                path: '/company/sunnyr-logout'
            }
        },
        
        forgotPassword:{
            create: {
                path: '/company/forgot-password-phone-request'
            },
            submit: {
                path: '/company/forgot-password-phone'
            }
        },

        resetPassword:{
            create: {
                path: '/company/reset-password-phone'
            },
            submit: {
                path: '/company/reset-password-phone-apply'
            }
        },

        contactus: {
            index: {
                path: '/company/contact-us'
            }
        }
    }   
}