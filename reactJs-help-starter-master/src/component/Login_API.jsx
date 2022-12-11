import React, { useState } from 'react';

function Login_API() {
    
    const [err, setError]  = useState('');
    const [data, setData] = useState();
    const [logindata,setLoginData] = useState({mail: "", password: ""})

    const handleClick = async () => {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/login',
            {
                method: 'POST',
                body: JSON.stringify ({
                    mail: "baptiste@email.com",
                    password: "123456789",
            }),
            headers : {'Content-Type': 'application/json', Accept: 'application/json',},
        });

        const result = await response.json();

        console.log('result is', JSON.stringify(result,null,4));

        setData(result);
        }
        
        catch (err) {
            setError(err.message);
        }
    };

        return (
            <div>
                {err && <h2>{err}</h2>}

                <button onClick={handleClick}> LOGIN</button>

                {data && (
                    <div>
                        <h2> {data.mail}</h2>
                        <h2>  {data.password}</h2>
                    </div>
                )}

            </div>


        )
    };

export default Login_API;