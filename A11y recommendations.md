I've analyzed your website and identified several accessibility issues. Here's a detailed report:

# Accessibility Issues Found

## 🔴 Critical Issues
1. Color Contrast Problems

The magenta text (#b24690) used for subtitles and headings has insufficient contrast on light backgrounds
"With you from concept to completion"
"BOOK A FREE CONSULTATION TODAY"
"TOP SERVICES" heading in contact section
WCAG AA requires 4.5:1 for normal text, 3:1 for large text

2. Hero Section Text Contrast

White text on the hero background image might fail contrast tests depending on image opacity
The overlay text needs darker background overlay or lighter text


## 🟡 Moderate Issues
3. External Link Icons

Links with external link icons (<i class="fas fa-external-link-alt"></i>) need better accessibility
Current aria-labels: "Visit Psychaesthesia", "Visit New Eleusis" don't indicate they open in new tabs

4. Mobile Menu Accessibility

The mobile navigation menu lacks role="region" or proper landmark
When menu is open, background not marked as inert

5. Image Alt Text

Venture logo images have alt text (good), but other images should be verified
Social media icons use aria-hidden="true" (correct) with aria-labels on links (good)
✅ Strong Practices (Keep These)
Skip to main content link implemented
Proper focus-visible styles on interactive elements
Form labels correctly associated with inputs
ARIA labels on navigation and form
Semantic HTML structure
Reduced motion preferences respected
Form success message has role="status" and aria-live="polite"


### Recommendations
Would you like me to fix these issues? I can:

Update magenta color to a more accessible shade (~7.5:1 contrast)
Fix hero section contrast by adjusting overlay opacity
Enhance external link labels to indicate new tab opening
Improve mobile menu accessibility with proper ARIA attributes
Add comprehensive alt text verification
Which would you like me to address first?