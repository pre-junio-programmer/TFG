import React from 'react';
import { ChakraProvider, Box, Heading, Text, Button, VStack, HStack, Image, Link } from '@chakra-ui/react';
import { ColorModeScript } from "@chakra-ui/react";
import theme from './theme';

function App() {
  return (
    <ChakraProvider theme={theme}>
      <ColorModeScript initialColorMode={theme.config.initialColorMode} />
      <Box textAlign="center" fontSize="xl">
        <Box bg="teal.500" p={4} color="white">
          <Heading as="h1" size="2xl">Bienvenido a Mi Sitio Web</Heading>
        </Box>
        <Box p={4}>
          <VStack spacing={8}>
            <HStack spacing={4}>
              <Image
                borderRadius="full"
                boxSize="150px"
                src="/varios/Mbappe.jpg"
                alt="Logo"
              />
              <VStack align="start">
                <Heading as="h2" size="xl">MBAPPE?</Heading>
                <Text fontSize="lg">Bienvenido al Real Madrid</Text>
              </VStack>
            </HStack>
            <Text fontSize="md">
              Esta es la página principal de nuestro increíble sitio web. Aquí encontrarás una variedad de recursos y enlaces para explorar.
            </Text>
            <Link href="/TFG/VISTA/InicioSesion.html">
              <Button colorScheme="teal" size="lg">
                Navegar
              </Button>
            </Link>
          </VStack>
        </Box>
      </Box>
    </ChakraProvider>
  );
}

export default App;
