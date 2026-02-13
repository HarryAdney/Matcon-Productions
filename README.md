# Matcon Productions

A modern, responsive website for Matcon Productions - a creative digital agency specializing in innovative solutions across education, media, and property industries.

## 🌟 Overview

Matcon Productions is a creative digital agency website that showcases the company's services and flagship ventures. The site features a clean, professional design with smooth animations, responsive layouts, and an integrated contact system.

## ✨ Features

- **Responsive Design**: Fully responsive layout that adapts seamlessly to desktop, tablet, and mobile devices
- **Modern UI/UX**: Clean, professional design with smooth animations and transitions
- **Hero Section**: Eye-catching hero with animated gradient background and wave effects
- **Services Showcase**: Three service areas (Education, Media, Property) with interactive cards
- **Ventures Portfolio**: Showcase of flagship projects with external links
- **Contact Form**: Integrated contact form with mailto functionality
- **Smooth Scrolling**: Enhanced navigation with smooth scroll behavior
- **Scroll Animations**: Elements animate into view using Intersection Observer API
- **Sticky Header**: Fixed header with dynamic shadow on scroll

## 🛠️ Technologies Used

- **HTML5**: Semantic markup for accessibility and SEO
- **CSS3**:
  - CSS Custom Properties (variables) for consistent theming
  - Flexbox and CSS Grid for layouts
  - CSS animations and transitions
  - Media queries for responsive design
- **JavaScript (ES6+)**:
  - DOM manipulation
  - Intersection Observer API for scroll animations
  - Form handling with mailto integration
- **External Resources**:
  - [Google Fonts - Inter](https://fonts.google.com/specimen/Inter)
  - [Font Awesome 6.4.0](https://fontawesome.com/) for icons

## 📁 Project Structure

```file structure
matcon-productions/
├── index.html              # Main HTML file
├── styles.css              # CSS styles with custom properties
├── script.js               # JavaScript functionality
├── logo.webp               # Main logo
├── logo-2.webp             # Alternative logo
├── logo-psychaesthesia.png # Psychaesthesia venture logo
├── logo-new-eleusis.png    # New Eleusis venture logo
├── matcon-logo.png         # Matcon logo asset
├── matcon-footer-example.jpeg  # Footer design reference
├── matcon-footer-example.webp  # Footer design reference (WebP)
└── .vscode/                # VS Code configuration
```

## 🎨 Design System

### Color Palette

The project uses a carefully curated color palette defined as CSS custom properties:

| Variable | Color | Usage |
| ---------- | ------- | ------- |
| `--primary-color` | `#1a365d` | Primary brand color |
| `--primary-light` | `#2c5282` | Lighter primary variant |
| `--primary-dark` | `#0f2440` | Darker primary variant |
| `--secondary-color` | `#6b46c1` | Secondary accent (purple) |
| `--accent-color` | `#4299e1` | Accent color (blue) |
| `--text-primary` | `#1a202c` | Main text color |
| `--text-secondary` | `#718096` | Secondary text color |

### Typography

- **Font Family**: Inter (with system font fallbacks)
- **Font Sizes**: Scale from `0.75rem` (xs) to `3rem` (5xl)
- **Font Weights**: 300 (light), 400 (regular), 600 (semi-bold), 700 (bold)

### Spacing Scale

Consistent spacing using rem units from `0.5rem` (xs) to `4rem` (2xl)

## 🚀 Getting Started

### Prerequisites

- A modern web browser (Chrome, Firefox, Safari, Edge)
- A local web server (optional, for development)

### Installation

1. Clone or download the project files
2. Open `index.html` directly in a web browser, or
3. Serve via a local development server:

    ```powershell
    # Using Python (if installed)
    python -m http.server 8000

    # Using Node.js http-server (if installed)
    npx http-server

    # Using PHP (if installed)
    php -S localhost:8000
    ```

4. Navigate to `http://localhost:8000` in your browser

## 📱 Responsive Breakpoints

- **Desktop**: > 768px
- **Tablet**: 481px - 768px
- **Mobile**: ≤ 480px

## 🔧 Customization

### Updating Colors

Modify the CSS custom properties in [`styles.css`](styles.css:8) within the `:root` selector:

```css
:root {
    --primary-color: #your-color;
    /* ... other variables */
}
```

### Adding New Ventures

Add a new venture card in [`index.html`](index.html:82) within the `.ventures-grid` container:

```html
<div class="venture-card">
    <div class="venture-image">
        <div class="venture-logo-container">
            <img src="your-logo.png" alt="Venture Name" class="venture-logo">
        </div>
    </div>
    <div class="venture-content">
        <h3>Venture Name</h3>
        <p>Description of the venture...</p>
        <a href="https://venture-url.com" class="venture-link" target="_blank">
            Visit Venture <i class="fas fa-external-link-alt"></i>
        </a>
    </div>
</div>
```

### Modifying Contact Information

Update the contact details in [`index.html`](index.html:130) within the `.contact-details` section.

## 📧 Contact Form

The contact form uses a mailto link to send form data to the default email client. The form:

1. Collects name, email, and message
2. Constructs a mailto URL with the form data
3. Opens the user's email client with pre-filled information
4. Resets the form after submission

To change the recipient email address, modify the email address in [`script.js`](script.js:11).

## 🌐 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Opera (latest)

## ⚡ Performance Features

- **CSS Variables**: Efficient theming and reduced CSS duplication
- **Optimized Animations**: Hardware-accelerated transforms and opacity changes
- **Lazy Animation**: Elements only animate when entering viewport
- **System Fonts Fallback**: Reduces font loading time

## 🔒 Accessibility

- Semantic HTML structure
- Descriptive alt text for images
- Focus states for interactive elements
- Sufficient color contrast ratios
- Keyboard navigation support

## 📄 License

© 2026 Matcon Productions Limited. All rights reserved.

## 🤝 Contributing

This is a private project for Matcon Productions. For inquiries, please contact the development team.

---

**Matcon Productions** | Creative Digital Solutions
