import React, {useState, useEffect} from 'react';

const EditCustomerForm = (props) => {

    const [customer, setCustomer] = useState(props.currentCustomer);

    const handleChange = e => {
        const {name, value} = e.target;
        setCustomer({...customer, [name]: value});
    }

    const handleSubmit = e => {
        e.preventDefault();
        if (customer.customerName && customer.company) props.updateCustomer(customer);
    }

    useEffect(() => {
        setCustomer(props.currentCustomer)
    }, [props])


    return (
        <form>
            <label>Name</label>
            <input className="u-full-width" type="text" value={customer.customerName} name="customerName" onChange={handleChange} />
            <label>Username</label>
            <input className="u-full-width" type="text" value={customer.company} name="company" onChange={handleChange} />
            <button className="button-primary" type="submit" onClick={handleSubmit} >Edit customer</button>
            <button type="submit" onClick={() => props.setEditing(false)} >Cancel</button>
        </form>
    )
}

export default EditCustomerForm;
