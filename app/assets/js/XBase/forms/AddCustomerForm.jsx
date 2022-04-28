import React, {useState} from 'react';

const AddCustomerForm = (props) => {

    const initCustomer = {id: null, customerName: '', company: ''};

    const [customer, setCustomer] = useState(initCustomer);

    const handleChange = e => {
        const {name, value} = e.target;
        setCustomer({...customer, [name]: value});
    }

    const handleSubmit = e => {
        e.preventDefault();
        if (customer.customerName && customer.company) {
            handleChange(e, props.addCustomer(customer));
        }
    }
    return (
        <form>
            <label>CustomerName</label>
            <input className="u-full-width" type="text" name="customerName" value={customer.customerName} onChange={handleChange} />
            <label>Company</label>
            <input className="u-full-width" type="text" name="company" value={customer.company} onChange={handleChange} />
            <button className="button-primary" type="submit" onClick={handleSubmit}>Add customer</button>
        </form>
    )
}

export default AddCustomerForm;
