import React, { useState } from 'react';

function Login_API() {
    
    const [err, setError]  = useState('');
    const [data, setData] = useState();
    const [logindata,setLoginData] = useState({name : "",mail: "", password: ""})

    //TOKENS

    const handleSubmit = e => {
        e.preventDefault()
        //Login(logindata)
    }

    const handleClick = async () => {

        //TOKENS
        let user = JSON.parse(sessionStorage.getItem('data'));
        const token = user.data.id; //Il bloque ici

        if (token == null) {
            console.log("Error, data null")
        }

        try {
            const response = await fetch('http://127.0.0.1:8000/api/login',
            {
                method: 'POST',
                body: JSON.stringify ({
                    mail: logindata.mail,
                    password: logindata.password,
            }),
            headers : {'Content-Type': 'application/json', Accept: 'application/json', 'Authorisation': `Bearer ${token}` },
        });

        const result = await response.json();
        console.log(token)
        console.log('result is', JSON.stringify(result,null,4));

        setData(result);
        }
        
        catch (err) {
            setError(err.message);
        }
    };

    const handleLogout = async () => {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/logout');
            const result2 = await response.json();
            console.log('result is', JSON.stringify(result2,null,4));

        }
        catch (err){
            setError(err.message);
        }
        setLoginData({name: "", email: ""})
    }

        return (
            <div>
                {err && <h2>{err}</h2>}

                <h2> LOGIN PART</h2>
            
                <div>
                    <form onSubmit={handleSubmit}>
                    <div className="form-group">
                        <label htmlFor="name"> Name:</label>
                        <input type="name" name="name" id="name" onChange={e => setLoginData({...logindata, name: e.target.value})} value={logindata.name}></input>
                    </div>
                    <div className="form-group">
                        <label htmlFor="mail"> Mail:</label>
                        <input type="mail" name="mail" id="mail" onChange={e => setLoginData({...logindata, mail: e.target.value})} value={logindata.mail}></input>
                    </div>
                    <div className="form-group">
                        <label htmlFor="password"> Password :</label>
                        <input type="password" name="password" id="password" onChange={e => setLoginData({...logindata, password: e.target.value})} value={logindata.password}></input>
                    </div>
                    <button type="submit" onClick={handleClick}> LOGIN</button>
                </form>
                </div>

                {<button onClick={handleLogout}> LOGOUT </button>}

                {data && (
                    <div>
                        <h2> {data.name}</h2>
                        <h2>  {data.mail}</h2>
                        <h2> {data.password}</h2>
                    </div>
                )}

            </div>


        )
    };


    function Patch_Request_Categories() {
        const [data, setData] = useState();
        const [err, setError]  = useState('');
        const [detailsuser,setDetailsUser] = useState({name: "", mail: "", password: ""});
    
    
        //PATCH UPDATE
        const handleSubmit = e => {
            e.preventDefault()
        }
    
        const handleClick = async () => {
            try {                               //Accès à la base ?!
                    const response = await fetch(`http://127.0.0.1:8000/api/categories/${detailscategories.id}`,
                    {
                        method: 'PATCH',
                        body: JSON.stringify({
                            mail: detailsuser.mail,
                            password: detailsuser.password,
                        }),
                        headers: { 'Content-Type': 'application/json', Accept: 'application/json',
                        },
                    });
    
                    //Erreur de fetch
                    if (!response.ok) {
                        throw new Error(`Error! status: ${response.status}`);
                    }
    
                    const result = await response.json();
                    setData(result);
                } 
                    catch (err) {
                        setError(err.message);
                    }
            };
    
            console.log(data);
    
            return (
                <div>
                    {err && <h2>{err}</h2>}
    
                    <button onClick={handleClick}> PATCH/UPDATE Login request</button>
    
                    {/*----------AJOUT----------*/}
                <form onSubmit={handleSubmit}>
                    <div className="form-group">
                        <label htmlFor="mail"> New mail:</label>
                        <input type="mail" name="mail" id="mail" onChange={e => setDetailsUser({...detailsuser, mail: e.target.value})} value={detailsuser.mail}></input>
                    </div>
                    <div className="form-group">
                        <label htmlFor="password"> New password: </label>
                        <input type="password" name="password" id="password" onChange={e => setDetailsUser({...detailsuser, password: e.target.value})} value={detailsuser.password}></input>
                    </div>
                    {/*------------------------------------------*/}
    
                    {data && (
                        <div>
                            <h2>Name: {data.name}</h2>
                            <h2>Password: {data.mail}</h2>
                        </div>
                    )}
                </form>
                </div>
            )
    }


export default Login_API;