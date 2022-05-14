import React, {useState, useEffect} from 'react';

const TestApp = () => {


    const [count1, setCount1] = useState(1);
    const [count2, setCount2] = useState(2);




    const random=()=>{
        setCount1(Math.floor(Math.random() * 18));
        setCount2(Math.floor(Math.random() * 15));
    }



    return (
        <div className="container">
       <input type="button" onClick={random} />

            <input type='text' value={count1}   />

            <p> calc</p>
            <input type='text' value={count2} />
            <input type='text' value={count1 + count2} />
        </div>

           );

}

export default TestApp