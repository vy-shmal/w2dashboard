<template>
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid" style="padding: 2rem 2rem;">
                <div class="container">
                    <h1 class="display-4">Super Offers Dashboard</h1>
                    <p class="lead">Show the data of the orders </p>

                    <date-picker v-model="date" lang="en" :first-day-of-week="1" ></date-picker>

                    <p >{{ formatedDate }}</p>

                    <p class="lead" style="text-align: right; font-size: 2rem;">
                        <a id="sync" href="#" @click="syncData()"><i class="icon ion-md-refresh"> Update</i></a>

                        <img v-show="loading"  :src="'/img/loading_12.gif'" style="width: 50px;" >
                    </p>

                </div>
            </div>
            <div class="container justify-content-center">
                <div class="row">
                    <div class="col col-sm-2">
                        <div class="w2cart">
                            <h5>Total Orders</h5>
                            <p>{{ordersCount}}</p>

                        </div>
                    </div>
                    <div class="col col-sm-3 ">
                        <div class="w2cart">
                            <h5>Grand Total without shipping</h5>
                            <p>{{this.grandTotalNoShipping()}} €</p>
                        </div>
                    </div>

                    <div class="col col-sm-7  ">
                        <div class="w2cart small-p">
                            <h5>Payment Methods</h5>


                            <p class="payment-method" v-for="(value, key) in shippingData" >
                                <span >{{ key }} : </span>
                                <span >{{ value.count }} : </span>
                                <span >{{ Math.floor(value.totalprice * 100) / 100 }} €</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container justify-content-center">
                <div class="row">


                    <div class="col col-sm-4" v-for="order in orders" v-bind:key="order.id">
                        <div class="card bg-light mb-3 " style="max-width: 18rem;" >
                            <div class="card-header">{{order.increment_id }}</div>
                            <div class="card-body">
                                <h5 class="card-title">Στοιχεία Παραγγελείας</h5>
                                <p class="card-text">
                                    <ul>
                                        <li> {{order.grand_total}}</li>
                                        <li> {{order.shipping_amount}}</li>
                                        <li> {{order.status}}</li>
                                        <li> {{order.method}}</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';

    export default {
        components: { DatePicker },
        data() {
            return {
                loading: false,
                orders: [],
                date:"",
                shippingData: {}
            }
        },
        created(){
            this.fetchOrders();
        },

        methods:{
            fetchOrders(){
                let url = "api/orders";

                if (this.date){
                    url = "api/orders/"+this.formatForApi();
                }

                fetch(url)
                    .then(res => res.json())
                    .then(res => {
                        this.orders = res.data;
                        this.calculateShippingData();
                        //console.log();
                    })
            },
            syncData(){
                this.loading = true;

                let url = "api/sync";

                if (this.date){
                    url = "api/sync/"+this.formatForApi();
                }

                fetch(url)
                    .then(res => res.json())
                    .then(res => {
                        //this.orders = res.data;
                        //console.log(res);
                        this.fetchOrders();

                        this.loading = false;

                    })

            },
            grandTotalNoShipping(){
                let total = 0;
                let shippingtotal = 0;

                //calculate the totals
                this.orders.map(obj => {
                    // total += Math.floor(obj.grand_total * 100) / 100;
                    // shippingtotal += Math.floor(obj.shipping_amount * 100) / 100;
                    total += Number(obj.grand_total);
                    shippingtotal += Number(obj.shipping_amount);

                });

                return  Math.floor((total - shippingtotal) * 100) / 100 ;

            },
            formatForApi(){
                if (this.date){
                   return this.$moment(this.date).format('YYYY-MM-DD');
                }

            },
            calculateShippingData(){

                for (const prop of Object.keys(this.shippingData)) {
                    delete  this.shippingData[prop];
                }



                this.orders.map(obj => {

                    this.shippingData[obj.method] = {
                        count : 0,
                        totalprice: 0
                    };
                });

                console.log(this.shippingData);

                this.orders.map(order => {

                    this.shippingData[order.method].count += 1 ;
                    this.shippingData[order.method].totalprice += Math.floor(Number(order.grand_total) * 100) / 100  ;

                });

                console.log(this.shippingData);
                //return this.shippingData;
            }

        },
        computed: {
            ordersCount: function(){
                return this.orders.length;
            },
            formatedDate(){
                if(this.date){
                    return this.$moment(this.date).format('DD-MM-YYYY');
                }else{
                    return this.$moment().format('DD-MM-YYYY');
                }

            }

        }

    }
</script>


<style scoped>
    .w2cart {
        background-color: #eaeaea;
        margin-bottom: 30px;
        padding: 10px;
    }

    .w2cart.small-p p {
        font-size: 1rem;
    }


    .w2cart p {
        margin-bottom: 0;
        border-top: 1px solid #ccc;
        font-size: 2rem;
        text-align: right;
        padding-right: 10px;
    }

    .payment-method span {
        display: inline-block;
        width: 80px;
    }

    .payment-method span:first-child {width:155px;}
</style>

