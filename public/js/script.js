// Créez une instance Vue
new Vue({
    el: '#app',
    data: {
        items: [], // Tableau pour stocker les données
        newItem: { name: '', email: '', devise: '' }, // Nouvelle donnée à ajouter
        editingId: null, // ID de l'élément en cours de modification
        searchQuery: '' // Recherche
    },
    mounted() {
        // Chargez les données depuis le localStorage lors du montage du composant
        if (localStorage.getItem('items')) {
            this.items = JSON.parse(localStorage.getItem('items'));
        } else {
            // Si aucune donnée n'est enregistrée localement, initialisez un tableau vide
            this.items = [];
        }
    },
    computed: {
        // Filtrer les éléments en fonction de la recherche
        filteredItems() {
            return this.items.filter(item => {
                // Vérifiez si la recherche correspond au nom, à l'email ou à la devise de l'élément
                return (
                    item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.email.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.devise.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            });
        }
    },
    methods: {
        startEditing(item) {
            // Démarrez la modification de l'élément
            this.editingId = item.id;
        },
        saveChanges(item) {
            // Stockez le nom de la donnée avant de la modifier
            const previousNameee = item.name;
            // Enregistrez les modifications de l'élément
            this.editingId = null; // Réinitialisez l'ID de l'élément en cours de modification
            localStorage.setItem('items', JSON.stringify(this.items)); // Mettez à jour les données dans le localStorage
            // Affichez une alerte avec le nom de la donnée modifiée
            alert("La modification de \"" + previousNameee + "\" est réussie avec succès");
        },
        confirmDelete(item) {
            // Demandez confirmation avant de supprimer l'élément
            if (confirm("Voulez-vous vraiment supprimer l'élément \"" + item.name + "\" ?")) {
                this.deleteItem(item.id);
            }
        },
        deleteItem(id) {
            // Supprimez un élément
            this.items = this.items.filter(item => item.id !== id);
            localStorage.setItem('items', JSON.stringify(this.items)); // Mettez à jour les données dans le localStorage
        },
        validateAndAddItem() {
            // Vérifiez si tous les champs sont remplis
            if (this.newItem.name && this.newItem.email && this.newItem.devise) {
                // Ajoutez un nouvel élément si tous les champs sont remplis
                var newId = this.items.length > 0 ? this.items[this.items.length - 1].id + 1 : 1;
                this.items.push({
                    id: newId,
                    name: this.newItem.name,
                    email: this.newItem.email,
                    devise: this.newItem.devise
                });
                const insertedNameee = this.newItem.name; // Stockez le nom de la donnée insérée
                this.newItem = { name: '', email: '', devise: '' }; // Réinitialisez le formulaire
                localStorage.setItem('items', JSON.stringify(this.items)); // Mettez à jour les données dans le localStorage
                alert("L'insertion de \"" + insertedNameee + "\" est réussie avec succès");
            } else {
                // Affichez un message d'erreur si un champ est vide
                alert("Veuillez remplir tous les champs avant d'ajouter une nouvelle donnée.");
            }
        }
    }
});
