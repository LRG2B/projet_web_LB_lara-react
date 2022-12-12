import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { usePostStore } from '../store/postStore';

import {Patch_Request_Articles,DELETE_Article_REQUEST,} from '../component/Articles_Request';

//Recup token
var token_sessionstorage = sessionStorage.getItem("letoken")
console.log(token_sessionstorage)

var recupDataID;

function Article() {
	let { id } = useParams();
	const [post, setPost] = useState(null);
	const { posts } = usePostStore();

	useEffect(() => {
		if (!id || !posts) return;
		setPost(posts.find((item) => Number(item.id) === Number(id)));
	}, [id, posts]);

	const HClick_Save_Articles = async () => {
        try {
                const response = await fetch('http://127.0.0.1:8000/api/save_blogs',
                {
                    method: 'POST',
                    body: JSON.stringify({
                        article_id: recupDataID,
                    }),
                    headers: { 'Content-Type': 'application/json', Accept: 'application/json',
                    },
                });
				console.log("ID enregistré", recupDataID)
                //Erreur de fetch
                if (!response.ok) {
                    throw new Error(`Error! status: ${response.status}`);
                }
                const result = await response.json();
            } 
                catch { console.log("ERROR"); }
        };


	return (
		<div>
			{post && (
				<>
				<script> {recupDataID = post.id} </script> {/*Recup DATA*/}
					<h2>{post.title}</h2>
					<p>{post.body}</p>
					<button onClick={HClick_Save_Articles}>Enregistrer son article </button>
					<Link to={`/`}>retour à la liste</Link>
				</>
			)}

			<Patch_Request_Articles />
			<DELETE_Article_REQUEST />
		</div>
	);
}


export default Article;
