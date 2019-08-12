
export default {
    state:{
       product: [], 
    },
    getters:{
        getProduct(state){
            return state.product
        }
    },
    actions:{
        allProduct(context){
            axios.get('/product')
            .then((response)=>{
                context.commit('products' , response.data.products)
            })
        }
    },
    mutations:{
        products(state,data){
            return state.product = data
        }
    }
}