import React from 'react';

const CustomersTable = (props) => {
    return (
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>CustomerName</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            { props.customers.length > 0 ? (
                props.customers.map((customer,key) => {
                    const {id, customerName, company} = customer;
                    return (
                        <tr  key={key}>
                            <td>{id}</td>
                            <td>{customerName}</td>
                            <td>{company}</td>
                            <td>
                                <button onClick={() => props.deleteCustomer(id)}>Delete</button>
                                <button onClick={() => props.editCustomer(id, customer)}>Edit</button>
                            </td>
                        </tr>
                    )
                })
            ) : (
                <tr>
                    <td colSpan={4}>No customers found</td>
                </tr>
            )
            }
            </tbody>
        </table>
    )
}

export default CustomersTable;