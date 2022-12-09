import React,{useState} from 'react';

function Post_Request_Categories() {

    const [data, setData] = useState();
    const [err, setError] = useState('');

    //Details/slug
    const [detailscategories,setDetailsCategories] = useState({name: "", slug: ""});

    const handleSubmit = e => {
        e.preventDefault()
    }

    const handleClick = async () => {
        try {
                const response = await fetch('http://127.0.0.1:8000/api/categories',
                {
                    method: 'POST',
                    body: JSON.stringify({
                        name: detailscategories.name,
                        slug: detailscategories.slug,
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

        return(
            <div>
                {err && <h2>{err}</h2>}

                <button onClick={handleClick}> POST request</button>

                {/*----------AJOUT----------*/}
            <form onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="name"> Name:</label>
                    <input type="text" name="name" id="name" onChange={e => setDetailsCategories({...detailscategories, name: e.target.value})} value={detailscategories.name}></input>
                </div>
                <div className="form-group">
                    <label htmlFor="name"> Slug:</label>
                    <input type="text" name="name" id="slug" onChange={e => setDetailsCategories({...detailscategories, slug: e.target.value})} value={detailscategories.slug}></input>
                </div>
                {/*------------------------------------------*/}

                {data && (
                    <div>
                        <h2>Name: {data.name}</h2>
                        <h2>Slug: {data.slug}</h2>
                    </div>
                )}
            </form>
            </div>
        );
};





function Patch_Request_Categories() {
    const [data, setData] = useState();
    const [err, setError]  = useState('');
    const [detailscategories,setDetailsCategories] = useState({name: "", slug: "", id: ""});


    //PATCH UPDATE
    const handleSubmit = e => {
        e.preventDefault()
    }

    const handleClick = async () => {
        try {
                const response = await fetch(`http://127.0.0.1:8000/api/categories/${detailscategories.id}`,
                {
                    method: 'PATCH',
                    body: JSON.stringify({
                        name: detailscategories.name,
                        slug: detailscategories.slug,
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

                <button onClick={handleClick}> PATCH/UPDATE request</button>

                {/*----------AJOUT----------*/}
            <form onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="name"> Name:</label>
                    <input type="text" name="name" id="name" onChange={e => setDetailsCategories({...detailscategories, name: e.target.value})} value={detailscategories.name}></input>
                </div>
                <div className="form-group">
                    <label htmlFor="name"> Slug:</label>
                    <input type="text" name="name" id="slug" onChange={e => setDetailsCategories({...detailscategories, slug: e.target.value})} value={detailscategories.slug}></input>
                </div>
                <div className="form-group">
                    <label htmlFor="name"> Id:</label>
                    <input type="text" name="name" id="Id" onChange={e => setDetailsCategories({...detailscategories, id: e.target.value})} value={detailscategories.id}></input>
                </div>
                {/*------------------------------------------*/}

                {data && (
                    <div>
                        <h2>Name: {data.name}</h2>
                        <h2>Slug: {data.slug}</h2>
                    </div>
                )}
            </form>
            </div>
        )
}


export {Post_Request_Categories,Patch_Request_Categories}