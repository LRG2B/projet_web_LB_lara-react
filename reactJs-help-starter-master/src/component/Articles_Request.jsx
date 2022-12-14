import React,{useState} from 'react';

function Patch_Request_Articles() {
    const [data, setData] = useState();
    const [err, setError]  = useState('');
    const [detailsArticles,setDetailsArticles] = useState({title: "", body: "", category_id: ""});



    //PATCH UPDATE
    const handleSubmit = e => {
        e.preventDefault()
    }

    const handleClick = async () => {
        try {                   
                const response = await fetch(window.location.href, //Permet de d'obtenir l'url de la page actuelle
                {
                    method: 'PATCH',
                    body: JSON.stringify({
                        title: detailsArticles.title,
                        body: detailsArticles.body,
                        category_id: detailsArticles.category_id,
                    }),
                    headers: { 'Content-Type': 'application/json', Accept: 'application/json',
                    },
                });

                //Erreur de fetch
                if (!response.ok) {
                    throw new Error(`Error! status: ${response.status}`);
                }

                const result = await response.json();

                console.log('result is', JSON.stringify(result,null,4));

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

                <button onClick={handleClick}> PATCH/UPDATE Articles request</button>
                {/*----------AJOUT----------*/}
            <form onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="name"> Name:</label>
                    <input type="text" name="name" id="title" onChange={e => setDetailsArticles({...detailsArticles, title: e.target.value})} value={detailsArticles.title}></input>
                </div>
                <div className="form-group">
                    <label htmlFor="name"> Body :</label>
                    <input type="text" name="name" id="body" onChange={e => setDetailsArticles({...detailsArticles, body: e.target.value})} value={detailsArticles.body}></input>
                </div>
                <div className="form-group">
                    <label htmlFor="name"> Category_ID:</label>
                    <input type="text" name="name" id="category_id" onChange={e => setDetailsArticles({...detailsArticles, category_id: e.target.value})} value={detailsArticles.category_id}></input>
                </div>
                {/*------------------------------------------*/}
            </form>
            </div>
        )
}


function DELETE_Article_REQUEST() {
    const [data, setData] = useState();
    const [err, setError]  = useState('');


    //DELETE
    const handleSubmit = e => {
        e.preventDefault()
    }

    const handleClick = async () => {
        try {
                const response = await fetch(window.location.href,
                {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json', Accept: 'application/json',},
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


        return (
            <div>
                {err && <h2>{err}</h2>}
            <form></form>
                <button onClick={handleClick}> DELETE request</button>
                {/*----------AJOUT----------*/}
            </div>
        )
}



export {Patch_Request_Articles,DELETE_Article_REQUEST};