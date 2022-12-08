export const usePostCategories = create((set) => ({
	categories: [],
	setCategories: (categories) => set((state) => ({categories: categories })),
}))
