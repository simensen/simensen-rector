{ pkgs ? import <nixpkgs> {}}:

let
  configuredPkgs = {
    php = pkgs.php.withExtensions ({ all, enabled }: enabled ++ (with all; [ gnupg ]));
  };
in
  pkgs.mkShell {
    name = "simensen-rector";
    packages = [
      pkgs.gnupg
      pkgs.yamllint
      configuredPkgs.php
      configuredPkgs.php.packages.composer
      configuredPkgs.php.packages.phive
    ];
    shellHook =
      ''
        export PATH=$(pwd)/tools:$PATH
      '';
  }
