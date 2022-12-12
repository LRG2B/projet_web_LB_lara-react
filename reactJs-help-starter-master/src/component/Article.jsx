import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { usePostStore } from '../store/postStore';

import {Patch_Request_Articles,DELETE_Article_REQUEST,} from '../component/Articles_Request';

var token_sessionstorage = sessionStorage.getItem("letoken")
console.log("TEST")
console.log(token_sessionstorage)


function Article() {
	let { id } = useParams();
	const [post, setPost] = useState(null);
	const { posts } = usePostStore();

	useEffect(() => {
		if (!id || !posts) return;
		setPost(posts.find((item) => Number(item.id) === Number(id)));
	}, [id, posts]);

	return (
		<div>
			{post && (
				<>
					<h2>{post.id}</h2>
					<h2>{post.title}</h2>
					<p>{post.body}</p>
					<Link to={`/`}>retour à la liste</Link>
				</>
			)}

			<Patch_Request_Articles />
			<DELETE_Article_REQUEST />
		</div>
	);
}

export default Article;
