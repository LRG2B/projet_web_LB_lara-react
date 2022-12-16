import React, {useState} from 'react'

//function avec paramêtres
function LoginForm({Login, error}) {

    //Sorte de tab pour recup datas
    const [details, setDetails] = useState({name: "", email: "", password: ""});

    //Pour recup datas et les mettres dans le tab
    const submitHandler = e => {
        e.preventDefault();
        Login(details);
    }

    return (
        //Pour faire comprendre que le submit du button va envoyer les données dans le tab
        <form onSubmit={submitHandler}>
            <div className="form-inner">
                <h2>Login</h2>
                {(error != "") ? (<div className='error'>{error}</div>) : ""}
                <div className="form-group">
                    <label htmlFor="name">Name: </label> {/*OnChange : dès qu'un changement est opéré*/}
                    <input type="text" name="name" id="name" onChange={e => setDetails({...details, name: e.target.value})} value={details.name}/>
                </div>
                <div className="form-group">
                    <label htmlFor="email">Email: </label>
                    <input type="email" name="email" id="email" onChange={e => setDetails({...details, email: e.target.value})} value={details.email}/>
                </div>
                <div className="form-group">
                    <label htmlFor="password">Password: </label>
                    <input type="password" name="password" id="password" onChange={e => setDetails({...details, password: e.target.value})} value={details.password}/>
                </div>
                <input type="submit" value="LOGIN" /> {/*Appelle juste la fonction Login donc console.log*/}

            </div>
        </form>
    )
}

export default LoginForm;