function updateSubcategories() {
  var subcategories = {
      1: [
          { id: '2', name: "Camera's" },
          { id: '13', name: "Fototoestellen" },
          { id: '28', name: "Overige" }
      ],
      2: [
          { id: '1', name: "DJ materiaal" },
          { id: '17', name: "Luidsprekers" },
          { id: '7', name: "Hoofdtelefoons" },
          { id: '26', name: "Overige" }
      ],
      3: [
          { id: '5', name: "Feestverlichting" },
          { id: '18', name: "Ondersteunende verlichting" },
          { id: '27', name: "Overige" }
      ],
      4: [
          { id: '20', name: "Tools" },
          { id: '29', name: "Overige" }
      ],
      5: [
          { id: '3', name: "Accessoires" },
          { id: '4', name: "Elektronica" },
          { id: '8', name: "Special effects" },
          { id: '9', name: "Tablet" },
          { id: '10', name: "Randapparatuur" },
          { id: '11', name: "High tech" },
          { id: '12', name: "Communicatie" },
          { id: '14', name: "Internet of Things" },
          { id: '15', name: "Accessoires" },
          { id: '23', name: "Projectie" },
          { id: '24', name: "Gaming" },
          { id: '25', name: "Instrumenten" },
          { id: '30', name: "Overige" }
      ],
      6: [
          { id: '19', name: "Brillen" },
          { id: '21', name: "Accessoires" },
          { id: '31', name: "Overige" }
      ]
  };

  var categorySelect = document.getElementById("category");
  var subcategorySelect = document.getElementById("subcategory");

  var selectedCategory = categorySelect.value;
  var options = subcategories[selectedCategory] || [];

  // Clear existing options
  subcategorySelect.innerHTML = "";

  // Add new options
  options.forEach(function(subcategory) {
      var option = document.createElement("option");
      option.value = subcategory.id;
      option.text = subcategory.name;
      subcategorySelect.appendChild(option);
  });
}

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("category").addEventListener("change", updateSubcategories);
  updateSubcategories(); // Update subcategories on page load
});