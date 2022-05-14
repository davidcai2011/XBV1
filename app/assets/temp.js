import axios from "axios";

const retrieveCustomers = () => {
    // const params = getRequestParams(searchCustomer, page, pageSize);
    // let payload = { name: 'John Doe', occupation: 'gardener' };
    // const searchParams = new URLSearchParams(payload);
    // console.log(params);

    //  const paramsString=getRequestParamsString(searchCustomer, page, pageSize);




    // const requestOptions = {
    //     method: "GET",
    //     headers: { "Content-Type": "application/json" },
    //      // body: JSON.stringify(params)
    // };
    try {
        console.log(paramsString);
        //  axios.get( 'http://localhost:8099/api/customers.jsonld'+paramsString)
        axios.get( 'http://localhost:8099/api/customers.jsonld')
            .then(function (response) {
                setCount(Math.ceil(response.data['hydra:totalItems']/4));

                console.log(response.data['hydra:view']['hydra:first']);
                setCustomers(response.data['hydra:member']);
                // setCustomers(response.data);
            })
    }
    catch (err) {
        console.warn("Something went wrong fetching the API...", err);
    }
    //
    // fetch('http://localhost:8090/customers', requestOptions)
    //
    //     .then(response => response.data())
    //     .console.log(response)
    //     // .then(res => console.log(res))
    //     // .then((response) => {
    //     //     const { tutorials, totalPages } = response.data;
    //     //     setTutorials(tutorials);
    //     //     setCount(totalPages);
    //     //     console.log(response => response.json());
    //     // })
    //     .catch((e) => {
    //         console.log(e);
    //     })
};

const getRequestParams = (searchCustomer, page, pageSize) => {
    let params = {};
    if (searchCustomer) {
        params["customer"] = searchCustomer;
    }
    if (page) {
        params["page"] = page - 1;
    }
    if (pageSize) {
        params["size"] = pageSize;
    }
    return params;
};
