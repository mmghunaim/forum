import Token from "./Token";
import AppStorage from './AppStorage'
class User{
    login(user){
        let myemail = user.email
            let mypass = user.password            
            axios({
                method: 'post',
                url: '/api/auth/login',
                data: {
                    email: myemail,
                    password: mypass
                }
            })
            .then(function(response) {
                if (Token.completeIsValid(response.data.access_token)) {
                    AppStorage.store(response.data.user,response.data.access_token)
                    // window.location.assign('/forum')
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    sotreAfterResponse(response){
        if (Token.completeIsValid(response.data.access_token)) {
            AppStorage.store(response.data.user,response.data.access_token)
            // this.$router.push({name : 'forum'})
            window.location.assign('/forum')
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken()

        if (storedToken) {
            if (Token.completeIsValid(storedToken)) {
                return true
            }
        }
        return false
    }

    isLoggedIn(){
        return this.hasToken()
    }

    logout(){
        AppStorage.clear()
        window.location.assign('/forum')     
    }

    userName(){
        if(this.isLoggedIn){
            return AppStorage.getUser()
        }
    }

    userId(){
        if(this.isLoggedIn){
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub
        }
    }

    own(id){
        return this.userId() == id
    }
}

export default User = new User();