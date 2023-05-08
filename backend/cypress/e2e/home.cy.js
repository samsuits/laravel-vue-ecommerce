describe('home page', () => {
    it('the h2 contains the correct text', () => {
        cy.visit('http://localhost:3000')
        cy.get('[data-test="hero-heading"]').contains("Sign in to your account")
    })
})
