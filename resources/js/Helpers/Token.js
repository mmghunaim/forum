class Token{

    isValid(token){
        const payload = this.payload(token)
        if (payload) {
            if (payload.iss == "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/signup") {
                return true
            }else{
                return false
            }
        }
    }
    
    payload(token){
        const payload = token.split('.')[1]
        return JSON.parse(atob(payload))
    }

    completeIsValid(token){
        // if (token) {
            const encodedpayload = token.split('.')[1]  
            
            const decodedPayload  = JSON.parse(atob(encodedpayload))

            if(decodedPayload){
                return decodedPayload.iss == 
                "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/signup" ? true : false
            }
        // }       
    }
    
}

export default Token = new Token()