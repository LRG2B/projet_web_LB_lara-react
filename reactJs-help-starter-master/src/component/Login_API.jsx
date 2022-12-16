import React, { useState } from 'react';

var token_sessionstorage = sessionStorage.getItem("letoken")
console.log(token_sessionstorage)

function Login_API() {
    
    const [err, setError]  = useState('');
    const [data, setData] = useState();
    const [logindata,setLoginData] = useState({name : "",email: "", password: ""})

    //TOKENS

    const handleSubmit = e => {
        e.preventDefault()
        //Login(logindata)
    }


    const handleClick = async () => {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/login',
            {
                method: 'POST',
                body: JSON.stringify ({
                    name: logindata.name,
                    email: logindata.email,
                    password: logindata.password,
            }),
            headers : {'Content-Type': 'application/json', Accept: 'application/json',Authorization : `Bearer ${token_sessionstorage}` },
        });

        const result = await response.json();
        //Recup token
        var letoken = result.access_token;
        sessionStorage.setItem("letoken",letoken)

        console.log("THE TOKEN", letoken);

        var token_sessionstorage = sessionStorage.getItem("letoken")
        console.log("TOKEN STOCKE ",token_sessionstorage)
        //const token = access_token;
        //console.log(token)
        console.log('result is', JSON.stringify(result,null,4));

        setData(result);
        }
        
        catch (err) {
            setError(err.message);
        }
        //Call in
    };

    //Pour API/ME return info du compte
    let Get_Request_Categories2 = async () =>  {

            var token_sessionstorage = sessionStorage.getItem("letoken")
            console.log("TOKEN STOCKE ",token_sessionstorage)
            try {
                const response = await fetch('http://127.0.0.1:8000/api/me', 
                { method: 'GET',
                    headers : {'Content-Type': 'application/json', Accept: 'application/json', Authorization : `Bearer ${token_sessionstorage}`},
                });

        const result = await response.json();
        console.log(result)
        }
        catch {
            console.log("ERROR")
        }
    };


    const handleLogout = async () => {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/logout',
            { method: 'GET',
                    headers : {'Content-Type': 'application/json', Accept: 'application/json', Authorization : `Bearer ${token_sessionstorage}`},
                });
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
                        <label htmlFor="mail"> Email:</label>
                        <input type="mail" name="mail" id="mail" onChange={e => setLoginData({...logindata, email: e.target.value})} value={logindata.email}></input>
                    </div>
                    <div className="form-group">
                        <label htmlFor="password"> Password :</label>
                        <input type="password" name="password" id="password" onChange={e => setLoginData({...logindata, password: e.target.value})} value={logindata.password}></input>
                    </div>
                    <button type="submit" onClick={handleClick}> LOGIN</button>
                </form>
                </div>

                {<button onClick={handleLogout}> LOGOUT </button>}
                {<button onClick={Get_Request_Categories2}>GET TOKEN - TEST</button>}

                {data && (
                    <div>
                        <h2> {data.name}</h2>
                        <h2>  {data.email}</h2>
                        <h2> {data.password}</h2>
                    </div>
                )}
            </div>
        )
    };


function Create_Accounts() {
    
        const [logindata,setLoginData] = useState({name : "",email: "", password: ""})
        
        const handleSubmit = e => {
            e.preventDefault()
            //Login(logindata)
        }
        const handleClick_Create_Accounts = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/register',
                {
                    method: 'POST',
                    body: JSON.stringify ({
                        name: logindata.name,
                        email: logindata.email,
                        password: logindata.password,
                }),
                headers : {'Content-Type': 'application/json', Accept: 'application/json', Authorization : `Bearer ${token_sessionstorage}`},
            });

            if (!response.ok) {
                throw new Error(`Error! status: ${response.status}`);
            }
    
            const result = await response.json();
            console.log('result is', JSON.stringify(result,null,4));
        }
            catch (err) {
                console.log("ERROR");
            }
        };
        return (
            <div>
                <p> Create accounts</p>
                <div>
                    <form onSubmit={handleSubmit}>
                    <div className="form-group">
                        <label htmlFor="name"> Name:</label>
                        <input type="name" name="name" id="name" onChange={e => setLoginData({...logindata, name: e.target.value})} value={logindata.name}></input>
                    </div>
                    <div className="form-group">
                        <label htmlFor="mail"> Email:</label>
                        <input type="mail" name="mail" id="mail" onChange={e => setLoginData({...logindata, email: e.target.value})} value={logindata.email}></input>
                    </div>
                    <div className="form-group">
                        <label htmlFor="password"> Password :</label>
                        <input type="password" name="password" id="password" onChange={e => setLoginData({...logindata, password: e.target.value})} value={logindata.password}></input>
                    </div>
                    <div> 8 caractères minimum</div>
                    <button type="submit" onClick={handleClick_Create_Accounts}> Create accounts</button>
                </form>
                </div>
            </div>)}

    function Patch_Request_Categories() {
        const [data, setData] = useState();
        const [err, setError]  = useState('');
        const [detailsuser,setDetailsUser] = useState({name: "", email: "", password: ""});
    
    
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
                            email: detailsuser.email,
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
                        <input type="mail" name="mail" id="mail" onChange={e => setDetailsUser({...detailsuser, email: e.target.value})} value={detailsuser.email}></input>
                    </div>
                    <div className="form-group">
                        <label htmlFor="password"> New password: </label>
                        <input type="password" name="password" id="password" onChange={e => setDetailsUser({...detailsuser, password: e.target.value})} value={detailsuser.password}></input>
                    </div>
                    {/*------------------------------------------*/}
    
                    {data && (
                        <div>
                            <h2>Name: {data.name}</h2>
                            <h2>Password: {data.email}</h2>
                        </div>
                    )}
                </form>
                </div>
            )
    }


export {Login_API,Create_Accounts};