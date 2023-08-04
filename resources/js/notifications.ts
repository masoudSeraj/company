export const notification = ($q, type: string, message: string | null) => {
    const notifications = {
        success: () => {
            return $q.notify({
                message: message ?? 'درخواست با موفقیت اجرا شد!',
                color: 'green',
                textColor: 'white',
            })
        },

        warning: ()=> {
            return $q.notify({
                message: message ?? 'خطایی پیش آمده است!',
                color: 'yellow',
                textColor: 'dark',
            })
        },

        error: () => {
            return $q.notify({
                message: message ?? 'خطایی پیش آمده است!',
                color: 'red',
                textColor: 'white',
            })
        }
    }

    if(notifications[type]){
        return notifications[type]
    }

}