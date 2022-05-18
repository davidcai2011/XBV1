import React, {useState, useEffect} from 'react';
import Pagination from "@material-ui/lab/Pagination";
import CustomersTable from './tables/CustomersTable';

import EditCustomerForm from "./forms/EditCustomerForm";
import customerAsyncRequest from "./hooks/customerAsyncRequest";
import axios from 'axios';
import url from 'url';
import Swal from 'sweetalert2'
import AddCustomerForm from "./forms/AddCustomerForm";

const CustomerApp = () => {



    const [searchCustomer, setSearchCustomer] = useState("");
    const [page, setPage] = useState(1);
    const [pagecount, setPagecount] = useState(1);
    const [pageSize, setPageSize] = useState(20);
    const pageSizes = [4, 8, 12];

    const onChangeSearchCustomer = (e) => {
        const searchCustomer = e.target.value;
        setSearchCustomer(searchCustomer);

    };
    const handlePageChange = (event, value) => {
        setPage(value);

    };
    const handlePageSizeChange = (event) => {
        setPageSize(event.target.value);
     //   setPage(1);
    };


    const getRequestParamsString = (searchCustomer, page, pageSize) => {
        let paramsString = '?';
        if (searchCustomer) {
            paramsString=paramsString+'customerName=' + searchCustomer;
        }
        if (page) {
            paramsString=paramsString+'&page='+page;
        }
        if (pageSize) {
            paramsString=paramsString+'&itemsPerPage='+pageSize;
        }
        return paramsString;
    };



    // const [data, loading] = customerAsyncRequest(5);

    const [loading, setLoading] = useState(false);
    const [customers, setCustomers] = useState([]);

        useEffect(() => {
            fetchCustomerList()
        }, [pagecount, page, pageSize])



    const fetchCustomerList = async () => {


        const paramsString=getRequestParamsString(searchCustomer, page, pageSize);
        try {
           console.log(paramsString);
            setLoading(true);

           await axios.get( 'http://localhost:8099/api/customers.jsonld'+paramsString)

            .then(function (response) {
                setPagecount(Math.ceil(response.data['hydra:totalItems']/pageSize));
                setCustomers(response.data['hydra:member']);
                setLoading(false);
            })
        }
        catch (err) {
            console.warn("Something went wrong fetching the API...", err);
            setLoading(false);
                    }
    }



    const deleteCustomer = (id) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/customers/${id}`)
                    .then(function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Customer deleted successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        fetchCustomerList()
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: {error},
                            showConfirmButton: false,
                            timer: 1500
                        })
                    });
            }
        })
    }

    const addCustomer = customer => {

        setCustomers([...customers, customer]);

     //   delete customer.id;


        const requestOptions = {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(customer)
        };

        console.log('json'+JSON.stringify(customer));
        fetch('http://localhost:8099/api/customers', requestOptions)
            .then(response => response.json())
            .then(res => console.log(res));


        fetchCustomerList();

        // console.log(customer);
        // axios.post('http://localhost:8090/api/customers', requestOptions)
        //     .then(function (response) {
        //         Swal.fire({
        //             icon: 'success',
        //             title: 'Customer saved successfully!',
        //             showConfirmButton: false,
        //             timer: 1500
        //         })
        //
        //     })
        //     .catch(function (error) {
        //         console.log('Error', error.response.data);
        //         Swal.fire({
        //             icon: 'error',
        //             title: {error},
        //             showConfirmButton: false,
        //             timer: 1500
        //         })
        //
        //     })

    }

    const [editing, setEditing] = useState(false);
    const initialCustomer = { id: null, customerName: "", company: "" };
    const [currentCustomer, setCurrentCustomer] = useState(initialCustomer);

    const editCustomer = (id, customer) => {
        setEditing(true);
        setCurrentCustomer(customer);
    };

    const updateCustomer = (newCustomer) => {
        setCustomers(
            customers.map((customer) => (customer.id === currentCustomer.id ? newCustomer : customer))
        );
        setCurrentCustomer(initialCustomer);

        setEditing(false);

        // updateCustomer(newUser.id, newUser);
        const id=newCustomer.id;
     //   delete newCustomer.id;
        const requestOptions = {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(newCustomer)
        };

        fetch(`/customers/${id}`, requestOptions)
            .then(response => response.json())
            .then(res => console.log(res));
    };


    return (
        <div className="container">
            <div className="col-md-12">
                <div className="input-group mb-3">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Search by customerName"
                        value={searchCustomer}
                        onChange={onChangeSearchCustomer}
                    />

                    <button
                        className="btn btn-outline-secondary"
                        type="button"
                        onClick={fetchCustomerList}
                    >
                        Search
                    </button>

                </div>
            </div>
            <div className="col-md-12">
                <h4>Customers List</h4>

                <div className="row">
                    {loading || !customers ? (
                        <p>Loading...</p>
                    ) : (

                        <div className="table-responsive col-md-12">

                            <div className="seven columns">

                                <CustomersTable
                                    customers={customers}
                                    deleteCustomer={deleteCustomer}
                                    editCustomer={editCustomer}
                                />

                            </div>
                            <div className="mt-3">
                                {/*{"Items per Page: "}*/}
                                {/*<select  onChange={handlePageSizeChange} value={pageSize}>*/}
                                {/*    {pageSizes.map((size) => (*/}
                                {/*        <option key={size} value={size}>*/}
                                {/*            {size}*/}
                                {/*        </option>*/}
                                {/*    ))}*/}

                                {/*</select>*/}
                                <Pagination
                                    className="my-3"
                                    count={pagecount}
                                    page={page}
                                    siblingCount={0}
                                    boundaryCount={1}
                                    variant="outlined"
                                    shape="rounded"
                                    onChange={handlePageChange}
                                />
                            </div>

                            <div className="five columns">
                                {editing ? (
                                    <div>
                                        <h2>Edit customer</h2>
                                        <EditCustomerForm
                                            currentCustomer={currentCustomer}
                                            setEditing={setEditing}
                                            updateCustomer={updateCustomer}
                                        />
                                    </div>
                                ) : (
                                    <div>
                                        <h2>Add customer</h2>
                                        <AddCustomerForm addCustomer={addCustomer} />
                                    </div>
                                )}
                            </div>
                        </div>

                    )}
                </div>
            </div>
        </div>
    )
}

export default CustomerApp
