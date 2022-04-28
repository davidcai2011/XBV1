import {useState, useEffect} from 'react';

const customerAsyncRequest = amount => {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(false);


    useEffect(() => {
        const fetchData = async () => {
            try {
                setLoading(true);


                // const response = await fetch( 'http://localhost:8080/customers/');
                const response = await fetch( 'http://localhost:8090/customers/');

                 const json = await response.json();
                // console.log(json[0].id);
                setData(json);
                setLoading(false);

            } catch (err) {
                console.warn("Something went wrong fetching the API...", err);
                setLoading(false);
            }
        }

        if (amount) {
            fetchData(amount);
        }
    }, [amount]);

    // console.log({setData});
    return [data, loading]
};

export default customerAsyncRequest;