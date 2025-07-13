{
  description = "PHP development environment for simensen-rector";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs = { self, nixpkgs, flake-utils }:
    flake-utils.lib.eachDefaultSystem (system:
      let
        pkgs = nixpkgs.legacyPackages.${system};
        
        configuredPkgs = {
          php = pkgs.php.withExtensions ({ all, enabled }: enabled ++ (with all; [ gnupg xdebug ]));
        };
      in
      {
        devShells.default = pkgs.mkShell {
          name = "simensen-rector";
          packages = [
            configuredPkgs.php
            configuredPkgs.php.packages.composer
            configuredPkgs.php.packages.phive
            pkgs.gnupg
            pkgs.yamllint
          ];
          shellHook = ''
            export PATH=$(pwd)/tools:$PATH
          '';
        };
      });
}
